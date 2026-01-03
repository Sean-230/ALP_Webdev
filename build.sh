#!/bin/bash

# Laravel Build Script for Deployment
# This script ensures all caches are properly cleared before building

echo "🔧 Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "🧹 Clearing all caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo "📦 Caching configuration..."
php artisan config:cache

echo "🗺️ Caching routes..."
php artisan route:cache

echo "👁️ Caching views..."
php artisan view:cache

echo "✅ Build completed successfully!"
