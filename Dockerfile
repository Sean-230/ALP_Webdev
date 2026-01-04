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

# Run composer scripts
RUN composer dump-autoload --optimize

# Run Laravel package discovery
RUN php artisan package:discover --ansi

# Publish Volt auth views (required for Fortify)
RUN php artisan volt:install --force 2>&1 || echo "Volt already installed"

# Try to publish Livewire Flux stubs (may fail if Flux not installed, that's ok)
RUN php artisan vendor:publish --tag=flux-config --force 2>&1 || echo "Flux config not published (not an error if Flux not used)"
RUN php artisan vendor:publish --tag=flux-views --force 2>&1 || echo "Flux views not published (not an error if Flux not used)"

# Build assets with Vite (AFTER publishing Flux views)
RUN npm run build && \
    echo "=== Vite Build Complete ===" && \
    ls -la public/build/ && \
    cat public/build/manifest.json

# Ensure build directory has correct permissions
RUN chmod -R 755 public/build

# Set storage permissions (777 for Railway to ensure sessions work)
RUN chmod -R 777 /app/storage /app/bootstrap/cache

# Expose port
EXPOSE 8000

# Start server
CMD echo "=== RAILWAY STARTUP ===" && \
    echo "PORT: ${PORT:-8000}" && \
    echo "APP_ENV: ${APP_ENV:-production}" && \
    echo "APP_URL: ${APP_URL}" && \
    echo "ASSET_URL: ${ASSET_URL}" && \
    echo "APP_DEBUG: ${APP_DEBUG}" && \
    echo "=== Clearing Caches ===" && \
    php artisan config:clear 2>&1 || echo "Config clear failed" && \
    php artisan route:clear 2>&1 || echo "Route clear failed" && \
    php artisan view:clear 2>&1 || echo "View clear failed" && \
    php artisan cache:clear 2>&1 || echo "Cache clear failed" && \
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
    php -r "echo 'Testing Vite asset path:'; echo PHP_EOL; \$manifest = json_decode(file_get_contents('public/build/manifest.json'), true); echo 'CSS file should be at: /build/' . \$manifest['resources/css/app.css']['file']; echo PHP_EOL; \$cssFile = 'public/build/' . \$manifest['resources/css/app.css']['file']; if (file_exists(\$cssFile)) { echo 'CSS file exists! Size: ' . filesize(\$cssFile) . ' bytes'; } else { echo 'ERROR: CSS file NOT found!'; } echo PHP_EOL;" && \
    echo "=== Running migrations FIRST (blocking) ===" && \
    php artisan migrate --force 2>&1 && \
    echo "=== Migrations completed ===" && \
    echo "=== Creating storage link ===" && \
    php artisan storage:link 2>&1 || echo "Storage link exists or failed" && \
    echo "=== Starting Laravel Server ===" && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000} --no-reload
