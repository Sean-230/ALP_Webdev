#!/bin/bash
# Build script for Vercel deployment

# Install composer dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Install npm dependencies and build assets
npm install
npm run build

echo "✓ Build completed successfully"
