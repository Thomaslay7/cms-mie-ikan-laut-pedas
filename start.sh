#!/bin/bash
# Railway Startup Script

echo "🚀 Starting Regina's Kitchen CMS..."

# Ensure directories exist
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
chmod -R 775 storage bootstrap/cache

# Laravel setup commands
php artisan package:discover --ansi || echo "Package discover failed, continuing..."
php artisan key:generate --force || echo "Key generation failed, continuing..."
php artisan migrate --force || echo "Migration failed, continuing..."
php artisan config:cache || echo "Config cache failed, continuing..."
php artisan storage:link || echo "Storage link failed, continuing..."

echo "✅ Laravel setup complete!"

# Start PHP server
echo "🌐 Starting web server on port ${PORT:-8000}..."
exec php -S 0.0.0.0:${PORT:-8000} -t public/ public/index.php
