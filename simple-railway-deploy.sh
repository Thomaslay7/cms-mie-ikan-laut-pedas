#!/bin/bash
# Pure Laravel Railway Deploy - No Docker, No Complexity

echo "🚀 Starting Pure Laravel Deploy..."

# Set environment
export APP_ENV=production
export APP_DEBUG=false

# Generate key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force --no-interaction
fi

# Run basic Laravel setup
php artisan migrate --force --no-interaction || echo "Migration skipped"
php artisan config:cache
php artisan storage:link || echo "Storage link exists"

echo "✅ Laravel deployment complete!"
echo "🌐 CMS ready at: Railway URL/admin"
