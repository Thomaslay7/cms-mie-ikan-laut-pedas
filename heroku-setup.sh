#!/bin/bash
# Heroku Deploy Setup for Regina's Kitchen CMS

echo "🚀 Setting up Heroku deployment..."

# Install Heroku CLI check
if ! command -v heroku &> /dev/null; then
    echo "❌ Heroku CLI not found!"
    echo "📥 Install from: https://devcenter.heroku.com/articles/heroku-cli"
    exit 1
fi

# Login to Heroku
echo "🔐 Login to Heroku..."
heroku login

# Create Heroku app
echo "📱 Creating Heroku app..."
read -p "Enter app name (e.g. regina-kitchen-cms): " APP_NAME
heroku create $APP_NAME --region us

# Add buildpacks
echo "📦 Adding buildpacks..."
heroku buildpacks:add heroku/nodejs
heroku buildpacks:add heroku/php

# Add database addon
echo "🗄️ Adding database..."
heroku addons:create jawsdb:kitefin

# Set environment variables
echo "⚙️ Setting environment variables..."
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_NAME="Regina's Kitchen CMS"
heroku config:set LOG_CHANNEL=errorlog

# Generate APP_KEY
APP_KEY=$(php artisan key:generate --show)
heroku config:set APP_KEY="$APP_KEY"

# Create Procfile
cat > Procfile << 'EOF'
web: vendor/bin/heroku-php-apache2 public/
release: php artisan migrate --force && php artisan db:seed --force
EOF

echo "✅ Heroku setup complete!"
echo "📝 Next steps:"
echo "1. git add ."
echo "2. git commit -m 'Heroku deployment setup'"
echo "3. git push heroku main"
