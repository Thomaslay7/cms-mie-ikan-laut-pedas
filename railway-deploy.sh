# Railway Deploy Script
echo "🚀 Starting Railway Deploy Process..."

# Generate Application Key
echo "📝 Generating Application Key..."
php artisan key:generate --force

# Run Database Migrations
echo "🗄️ Running Database Migrations..."
php artisan migrate --force

# Seed Database (only on first deploy)
echo "🌱 Seeding Database..."
php artisan db:seed --force

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
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "✅ Deploy Complete!"
