#!/bin/bash
set -e

echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction
npm install
npm run build

echo "Setting up storage..."
php artisan storage:link || true

echo "Build completed!"
