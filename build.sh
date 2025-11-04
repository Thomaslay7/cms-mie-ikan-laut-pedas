#!/bin/bash
# Simple Railway Build Script

echo "🚀 Building Regina's Kitchen CMS..."

# Install dependencies
composer install --no-dev --ignore-platform-reqs --optimize-autoloader
npm ci && npm run build

# Generate key if not exists
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations and setup
php artisan migrate --force
php artisan config:cache
php artisan storage:link

echo "✅ Build complete!"
