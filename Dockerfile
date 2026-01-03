# Use PHP 8.4 FPM
FROM php:8.4-fpm

# Install system dependencies and Nginx
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    nodejs \
    npm \
    gettext-base

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm ci && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Configure PHP-FPM to listen on TCP socket instead of Unix socket
RUN sed -i 's/listen = .*/listen = 127.0.0.1:9000/' /usr/local/etc/php-fpm.d/www.conf

# Configure Nginx
RUN echo 'server {\n\
    listen $PORT;\n\
    server_name _;\n\
    root /var/www/html/public;\n\
    index index.php;\n\
    \n\
    add_header X-Frame-Options "SAMEORIGIN";\n\
    add_header X-Content-Type-Options "nosniff";\n\
    \n\
    charset utf-8;\n\
    \n\
    location / {\n\
        try_files $uri $uri/ /index.php?$query_string;\n\
    }\n\
    \n\
    location = /favicon.ico { access_log off; log_not_found off; }\n\
    location = /robots.txt  { access_log off; log_not_found off; }\n\
    \n\
    error_page 404 /index.php;\n\
    \n\
    location ~ \.php$ {\n\
        fastcgi_pass 127.0.0.1:9000;\n\
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;\n\
        include fastcgi_params;\n\
        fastcgi_read_timeout 300;\n\
    }\n\
    \n\
    location ~ /\.(?!well-known).* {\n\
        deny all;\n\
    }\n\
}' > /etc/nginx/sites-available/default.template

# Create startup script
RUN echo '#!/bin/bash\n\
set -e\n\
export PORT=${PORT:-8080}\n\
echo "========================================"\n\
echo "Starting Laravel Application"\n\
echo "Port: $PORT"\n\
echo "========================================"\n\
\n\
# Substitute PORT in nginx config\n\
envsubst \"\\$PORT\" < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default\n\
\n\
echo "Nginx Configuration:"\n\
cat /etc/nginx/sites-available/default\n\
echo "========================================"\n\
\n\
# Start PHP-FPM\n\
echo "Starting PHP-FPM..."\n\
php-fpm -D\n\
sleep 2\n\
\n\
# Verify PHP-FPM is listening\n\
if netstat -tuln | grep 9000; then\n\
    echo "PHP-FPM is listening on port 9000"\n\
else\n\
    echo "ERROR: PHP-FPM is not listening on port 9000"\n\
    exit 1\n\
fi\n\
\n\
# Test nginx config\n\
echo "Testing Nginx configuration..."\n\
nginx -t\n\
\n\
# Start Nginx\n\
echo "Starting Nginx on port $PORT..."\n\
echo "========================================"\n\
nginx -g "daemon off;"' > /usr/local/bin/start.sh && chmod +x /usr/local/bin/start.sh

# Install netstat for debugging
RUN apt-get install -y net-tools

EXPOSE 8080

CMD ["/usr/local/bin/start.sh"]
