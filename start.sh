#!/bin/bash
set -e

echo "Running database migrations..."
php artisan migrate:fresh --force --seed

echo "Starting web server..."
php -S 0.0.0.0:${PORT:-8000} -t public public/index.php
