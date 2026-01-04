FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies (production only)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Copy package files
COPY package.json package-lock.json ./

# Install npm dependencies
RUN npm ci

# Copy application files
COPY . .

# Build assets with Vite
RUN npm run build && \
    echo "=== Vite Build Complete ===" && \
    ls -la public/build/ && \
    cat public/build/manifest.json

# Run composer scripts after files are copied
RUN composer dump-autoload --optimize

# Run Laravel package discovery
RUN php artisan package:discover --ansi

# Set permissions
RUN chmod -R 755 /app/storage /app/bootstrap/cache

# Expose port
EXPOSE 8000

# Start server
CMD echo "=== RAILWAY STARTUP ===" && \
    echo "PORT: ${PORT:-8000}" && \
    echo "APP_ENV: ${APP_ENV:-production}" && \
    echo "APP_URL: ${APP_URL}" && \
    echo "ASSET_URL: ${ASSET_URL}" && \
    echo "=== Clearing Caches ===" && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear && \
    echo "=== Checking Build Assets ===" && \
    echo "Build directory:" && \
    ls -la public/build/ && \
    echo "CSS directory:" && \
    ls -la public/css/ && \
    echo "Images directory:" && \
    ls -la public/images/ && \
    echo "Vite Manifest:" && \
    cat public/build/manifest.json && \
    echo "" && \
    echo "=== Testing Asset Loading ===" && \
    php -r "echo 'Testing Vite asset path:'; echo PHP_EOL; \$manifest = json_decode(file_get_contents('public/build/manifest.json'), true); echo 'CSS file should be at: /build/' . \$manifest['resources/css/app.css']['file']; echo PHP_EOL;" && \
    echo "=== Starting migrations in background ===" && \
    (php artisan migrate --force 2>&1 || echo "Migration skipped") & \
    echo "=== Starting Laravel Server (NO CONFIG CACHE) ===" && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000} --no-reload
