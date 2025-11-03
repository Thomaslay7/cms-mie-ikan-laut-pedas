#!/bin/bash
# GitHub Setup for Regina's Kitchen CMS

echo "🚀 Setting up GitHub repository..."

# Initialize git if not already done
if [ ! -d ".git" ]; then
    git init
    echo "📝 Git repository initialized"
fi

# Create .gitignore if not exists
if [ ! -f ".gitignore" ]; then
    cat > .gitignore << 'EOF'
/node_modules
/public/build
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.env.production
.phpunit.result.cache
Homestead.json
Homestead.yaml
auth.json
npm-debug.log
yarn-error.log
/.fleet
/.idea
/.vscode
EOF
fi

# Create GitHub Actions workflow
mkdir -p .github/workflows
cat > .github/workflows/deploy.yml << 'EOF'
name: Deploy Regina's Kitchen CMS

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
        extensions: mbstring, xml, ctype, iconv, intl, pdo, pdo_mysql, dom, filter, gd, json, zip

    - name: Setup Node.js
      uses: actions/setup-node@v3
      with:
        node-version: '18'

    - name: Install dependencies
      run: |
        composer install --no-dev --optimize-autoloader
        npm ci && npm run build

    - name: Deploy to production
      run: |
        echo "🚀 Ready for deployment!"
        # Add your deployment commands here
EOF

# Create README for deployment
cat > DEPLOYMENT.md << 'EOF'
# 🚀 Regina's Kitchen CMS - Deployment Guide

## Platform Options:

### 1. Vercel (Easiest)
```bash
chmod +x vercel-setup.sh
./vercel-setup.sh
```

### 2. Render (Best for Database)
```bash
chmod +x render-setup.sh
./render-setup.sh
```

### 3. Heroku (Most Reliable)
```bash
chmod +x heroku-setup.sh
./heroku-setup.sh
```

### 4. Netlify + PlanetScale
```bash
chmod +x netlify-setup.sh
./netlify-setup.sh
```

## Environment Variables Needed:
- APP_KEY (generate with: php artisan key:generate --show)
- DATABASE_URL
- APP_ENV=production
- APP_DEBUG=false

## After Deploy:
1. Create admin user: php artisan make:filament-user
2. Access: https://your-app/admin
3. Upload logo and content
EOF

echo "✅ GitHub repository setup complete!"
echo "📝 Next steps:"
echo "1. Create repository on GitHub"
echo "2. git add ."
echo "3. git commit -m 'Initial commit - Regina Kitchen CMS'"
echo "4. git remote add origin https://github.com/username/regina-kitchen-cms.git"
echo "5. git push -u origin main"
echo "6. Choose deployment platform and run setup script"
