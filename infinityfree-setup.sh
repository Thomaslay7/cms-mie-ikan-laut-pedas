#!/bin/bash
# InfinityFree Hosting Setup - 100% FREE with PHP & MySQL

echo "🆓 Setting up InfinityFree hosting deployment..."

# Create .htaccess for shared hosting
cat > public/.htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Handle Angular and Ember.js requests
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

    # Remove public from URL
    RewriteCond %{THE_REQUEST} \s/+(.*/)?public/([^\s?]*) [NC]
    RewriteRule ^ /%1%2 [R=301,L]
    RewriteRule ^((?!public/).*)$ public/$1 [L,NC]
</IfModule>
EOF

# Create upload script for cPanel
cat > upload-to-infinityfree.sh << 'EOF'
#!/bin/bash
echo "📦 Preparing files for InfinityFree upload..."

# Create production build
composer install --no-dev --optimize-autoloader
npm ci && npm run build

# Create upload package
mkdir -p infinityfree-package
cp -r app infinityfree-package/
cp -r bootstrap infinityfree-package/
cp -r config infinityfree-package/
cp -r database infinityfree-package/
cp -r public infinityfree-package/
cp -r resources infinityfree-package/
cp -r routes infinityfree-package/
cp -r storage infinityfree-package/
cp -r vendor infinityfree-package/
cp artisan infinityfree-package/
cp composer.json infinityfree-package/
cp composer.lock infinityfree-package/

# Create .env for InfinityFree
cat > infinityfree-package/.env << 'ENVEOF'
APP_NAME="Regina's Kitchen CMS"
APP_ENV=production
APP_KEY=base64:sB7G+i9j3zR6kZN7I1a+wnn4nWq0Gdy/u3R/TiDngQc=
APP_DEBUG=false
APP_URL=https://your-subdomain.epizy.com

LOG_CHANNEL=single
LOG_LEVEL=error

# InfinityFree MySQL Database (FREE)
DB_CONNECTION=mysql
DB_HOST=sql110.epizy.com
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls

FILAMENT_FILESYSTEM_DISK=public
ENVEOF

echo "✅ Package ready for upload to InfinityFree!"
echo "📁 Upload folder: infinityfree-package/"
EOF

chmod +x upload-to-infinityfree.sh

echo "✅ InfinityFree setup complete!"
echo "📝 Steps:"
echo "1. Register at infinityfree.net (100% FREE)"
echo "2. Create hosting account"
echo "3. Run: ./upload-to-infinityfree.sh"
echo "4. Upload infinityfree-package/ via File Manager"
echo "5. Create MySQL database in cPanel"
echo "6. Update .env with database details"
