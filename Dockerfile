FROM php:8.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nginx \
    supervisor \
    gettext-base

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Remove default nginx config
RUN rm /etc/nginx/sites-enabled/default

# Copy application
COPY . /var/www

# Install composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Install Node.js for building frontend assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Install npm dependencies and build assets
RUN npm ci && npm run build

# Set proper permissions for all files and directories
RUN chown -R www-data:www-data /var/www \
    && find /var/www -type f -exec chmod 644 {} \; \
    && find /var/www -type d -exec chmod 755 {} \; \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

# Create nginx config template
COPY <<EOF /etc/nginx/sites-available/laravel
server {
    listen \${PORT};
    server_name _;
    root /var/www/public;
    index index.php index.html;
    
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    
    # Serve static files directly
    location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2|ttf|eot|map)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
        try_files \$uri =404;
    }
    
    # Serve build assets (Vite)
    location /build/ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
        try_files \$uri =404;
    }
    
    # PHP files
    location ~ \.php$ {
        try_files \$uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_param PATH_INFO \$fastcgi_path_info;
        include fastcgi_params;
    }
    
    # All other requests
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }
    
    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }
}
EOF

# Create startup script to handle PORT variable
COPY <<'EOF' /usr/local/bin/start.sh
#!/bin/bash
set -e

cd /var/www

echo "=== RAILWAY STARTUP ==="
echo "PORT: ${PORT:-8080}"
echo "APP_ENV: ${APP_ENV:-production}"

# Set default PORT if not provided
export PORT=${PORT:-8080}

# Replace PORT placeholder in nginx config
envsubst '$PORT' < /etc/nginx/sites-available/laravel > /etc/nginx/sites-enabled/laravel

# Verify built assets exist
echo "=== Checking Vite Build Files ==="
if [ -d "public/build" ]; then
    ls -la public/build/
    if [ -f "public/build/manifest.json" ]; then
        echo "manifest.json found:"
        cat public/build/manifest.json
    else
        echo "WARNING: manifest.json not found!"
    fi
else
    echo "WARNING: public/build directory not found!"
fi

# Verify and fix permissions
echo "=== Checking Permissions ==="
ls -la public/
ls -la public/build/ || echo "Cannot list build directory"
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Clear any old cached config from build
php artisan config:clear
php artisan cache:clear

# Run Laravel optimizations with production environment
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run Laravel migrations (if DB connection is available)
if [ ! -z "$DB_HOST" ] || [ ! -z "$DATABASE_URL" ]; then
    echo "=== Running Migrations ==="
    php artisan migrate --force || echo "Migration failed or no database connection"
fi

echo "=== Starting Services ==="
# Start supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
EOF

RUN chmod +x /usr/local/bin/start.sh

# Configure PHP-FPM
RUN sed -i 's/listen = .*/listen = 127.0.0.1:9000/' /usr/local/etc/php-fpm.d/www.conf

# Create supervisor config
COPY <<EOF /etc/supervisor/conf.d/supervisord.conf
[supervisord]
nodaemon=true
user=root
logfile=/var/log/supervisor/supervisord.log
pidfile=/var/run/supervisord.pid

[program:php-fpm]
command=/usr/local/sbin/php-fpm -F
autostart=true
autorestart=true
priority=5
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0

[program:nginx]
command=/usr/sbin/nginx -g 'daemon off;'
autostart=true
autorestart=true
priority=10
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
EOF

EXPOSE 8080

CMD ["/usr/local/bin/start.sh"]
