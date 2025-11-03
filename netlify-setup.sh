#!/bin/bash
# Netlify + PlanetScale Setup for Regina's Kitchen CMS

echo "🚀 Setting up Netlify + PlanetScale deployment..."

# Create netlify.toml
cat > netlify.toml << 'EOF'
[build]
  command = "composer install --no-dev --optimize-autoloader && npm ci && npm run build"
  functions = "netlify/functions"
  publish = "public"

[build.environment]
  PHP_VERSION = "8.2"

[[redirects]]
  from = "/admin/*"
  to = "/.netlify/functions/php/:splat"
  status = 200

[[redirects]]
  from = "/api/*"
  to = "/.netlify/functions/php/:splat"
  status = 200

[[redirects]]
  from = "/*"
  to = "/.netlify/functions/php/:splat"
  status = 200

[functions]
  directory = "netlify/functions"

[[plugins]]
  package = "@netlify/plugin-php"
EOF

# Create Netlify Functions directory
mkdir -p netlify/functions
cat > netlify/functions/php.php << 'EOF'
<?php
// Netlify Functions entry point
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../bootstrap/app.php';

$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();
$kernel->terminate($request, $response);
EOF

echo "✅ Netlify configuration created!"
echo "📝 Database setup:"
echo "1. Create PlanetScale account (free tier)"
echo "2. Create database: regina-kitchen"
echo "3. Get connection string"
echo "4. Set in Netlify environment variables"
