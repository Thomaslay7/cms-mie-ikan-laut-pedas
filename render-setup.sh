#!/bin/bash
# Render Deploy Setup for Regina's Kitchen CMS

echo "🚀 Setting up Render deployment..."

# Create render.yaml
cat > render.yaml << 'EOF'
databases:
  - name: regina-kitchen-db
    databaseName: regina_kitchen
    user: regina_user
    region: singapore

services:
  - type: web
    name: regina-kitchen-cms
    env: php
    buildCommand: |
      composer install --no-dev --optimize-autoloader
      npm ci && npm run build
      php artisan key:generate --force
      php artisan config:cache
      php artisan route:cache
      php artisan view:cache
    startCommand: |
      php artisan migrate --force
      php artisan db:seed --force
      vendor/bin/heroku-php-apache2 public/
    envVars:
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: APP_NAME
        value: "Regina's Kitchen CMS"
      - key: DB_CONNECTION
        value: pgsql
      - key: DATABASE_URL
        fromDatabase:
          name: regina-kitchen-db
          property: connectionString
    region: singapore
    plan: free
EOF

echo "✅ Render configuration created!"
echo "📝 Next steps:"
echo "1. Push to GitHub"
echo "2. Connect repository to Render"
echo "3. Deploy automatically!"
