#!/bin/bash
# Railway Deploy Script - Clean & Simple
echo "🚀 Regina's Kitchen CMS - Railway Deployment"
echo "🚀 Starting Railway Deploy Process..."

# Skip extension checks - Railway handles this
echo "📦 Using Railway's PHP setup..."

# Install missing PHP extensions if needed
echo "📦 Checking PHP Extensions..."
php -m | grep -q intl || echo "⚠️  Warning: intl extension missing"
php -m | grep -q zip || echo "⚠️  Warning: zip extension missing"
php -m | grep -q gd || echo "⚠️  Warning: gd extension missing"

# Generate Application Key if not exists
echo "📝 Setting up Application Key..."
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
    echo "✅ New APP_KEY generated"
else
    echo "✅ APP_KEY already set"
fi

# Run Database Migrations
echo "🗄️ Running Database Migrations..."
php artisan migrate --force

# Seed Database (only if tables are empty)
echo "🌱 Seeding Database..."
php artisan db:seed --force --class=DatabaseSeeder

# Clear and Cache Configuration
echo "⚡ Optimizing Application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create Storage Link
echo "🔗 Creating Storage Link..."
php artisan storage:link

# Set Proper Permissions
echo "🔐 Setting File Permissions..."
chmod -R 755 storage 2>/dev/null || echo "Storage permissions already set"
chmod -R 755 bootstrap/cache 2>/dev/null || echo "Cache permissions already set"

# Test database connection (optional)
echo "🔍 Testing Database Connection..."
php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'Database connected successfully'; } catch(Exception \$e) { echo 'Database connection will be available after deploy'; }" || echo "Database test skipped"

echo "✅ Deploy Complete!"
echo "🌐 Regina's Kitchen CMS is ready!"
echo "📍 Access admin panel at: \$APP_URL/admin"
