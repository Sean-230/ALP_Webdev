#!/bin/sh

# Exit on error
set -e

echo "=== Laravel Startup Script ==="
echo "PORT: $PORT"
echo "DB_HOST: $DB_HOST"
echo "APP_ENV: $APP_ENV"

echo "Running migrations..."
php artisan migrate --force --no-interaction || echo "Migration failed, continuing..."

echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "Starting web server on 0.0.0.0:$PORT..."
php -S 0.0.0.0:$PORT -t public/
