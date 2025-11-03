#!/bin/bash
# 100% FREE Deployment - No Credit Card Required

echo "🆓 Setting up 100% FREE deployment..."

# Update database to SQLite (no external DB needed)
cat > database/database.sqlite << 'EOF'
# SQLite database file will be created here
EOF

# Update .env for SQLite
cat > .env.free << 'EOF'
# 100% FREE Configuration - No Credit Card Required
APP_NAME="Regina's Kitchen CMS"
APP_ENV=production
APP_KEY=base64:sB7G+i9j3zR6kZN7I1a+wnn4nWq0Gdy/u3R/TiDngQc=
APP_DEBUG=false
APP_URL=https://regina-kitchen.github.io

LOG_CHANNEL=single
LOG_LEVEL=error

# SQLite Database (100% FREE - No external service needed)
DB_CONNECTION=sqlite
DB_DATABASE=/tmp/database.sqlite

# Simple Configuration
BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

# No Mail Configuration Needed
MAIL_MAILER=log

# Filament Configuration
FILAMENT_FILESYSTEM_DISK=local
EOF

# Create GitHub Pages deployment
mkdir -p .github/workflows
cat > .github/workflows/deploy-free.yml << 'EOF'
name: FREE Deploy - Regina's Kitchen CMS

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v3

    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        extensions: mbstring, xml, ctype, iconv, pdo, pdo_sqlite, dom, filter, json

    - name: Install dependencies
      run: |
        composer install --no-dev --optimize-autoloader

    - name: Setup application
      run: |
        cp .env.free .env
        php artisan key:generate --force
        touch database/database.sqlite
        php artisan migrate --force
        php artisan db:seed --force
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache

    - name: Build for production
      run: |
        npm ci && npm run build

    - name: Deploy to GitHub Pages
      uses: peaceiris/actions-gh-pages@v3
      with:
        github_token: ${{ secrets.GITHUB_TOKEN }}
        publish_dir: ./public
        publish_branch: gh-pages
EOF

echo "✅ 100% FREE setup complete!"
echo "📝 Next steps:"
echo "1. git add ."
echo "2. git commit -m 'FREE deployment setup'"
echo "3. git push origin main"
echo "4. Enable GitHub Pages in repository settings"
echo "5. Access: https://your-username.github.io/regina-kitchen-cms"
