#!/bin/bash
# Simple Railway Deploy
echo "🚀 Starting Laravel deployment..."

# Generate key if needed
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Run migrations
php artisan migrate --force

# Cache config
php artisan config:cache

# Create storage link
php artisan storage:link

echo "✅ Laravel deployment complete!"
