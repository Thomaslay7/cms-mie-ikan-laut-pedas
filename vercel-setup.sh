#!/bin/bash
# Vercel Deploy Setup for Regina's Kitchen CMS

echo "🚀 Setting up Vercel deployment..."

# Install Vercel CLI (if not installed)
if ! command -v vercel &> /dev/null; then
    echo "📦 Installing Vercel CLI..."
    npm install -g vercel
fi

# Create vercel.json configuration
cat > vercel.json << 'EOF'
{
  "version": 2,
  "builds": [
    {
      "src": "api/index.php",
      "use": "vercel-php@0.6.0"
    },
    {
      "src": "public/**",
      "use": "@vercel/static"
    }
  ],
  "routes": [
    {
      "src": "/(css|js|images)/(.*)",
      "dest": "public/$1/$2"
    },
    {
      "src": "/(.*)",
      "dest": "api/index.php"
    }
  ],
  "env": {
    "APP_ENV": "production",
    "APP_DEBUG": "false",
    "APP_URL": "https://regina-kitchen.vercel.app"
  }
}
EOF

# Create API directory for Vercel
mkdir -p api
cat > api/index.php << 'EOF'
<?php
// Vercel serverless entry point
require __DIR__ . '/../public/index.php';
EOF

echo "✅ Vercel configuration created!"
echo "📝 Next steps:"
echo "1. Run: vercel --prod"
echo "2. Follow the setup prompts"
echo "3. Set environment variables in Vercel dashboard"
