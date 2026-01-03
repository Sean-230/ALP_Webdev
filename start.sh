#!/bin/bash
set -e

echo "Running database migrations..."
php artisan migrate:fresh --force --seed

echo "Starting web server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
