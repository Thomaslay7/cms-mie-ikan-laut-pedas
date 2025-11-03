# Railway Alternative Deploy - Without Heavy Extensions

# Replace heavy packages with lighter alternatives
composer remove spatie/laravel-medialibrary --no-update
composer remove maatwebsite/excel --no-update  
composer remove intervention/image-laravel --no-update

# Install lighter alternatives
composer require "league/flysystem-aws-s3-v3" --no-update
composer require "spatie/simple-excel" --no-update

# Update composer with ignore platform requirements
composer update --ignore-platform-req=ext-intl --ignore-platform-req=ext-zip --ignore-platform-req=ext-gd --no-dev --optimize-autoloader

echo "✅ Lightweight deploy configuration completed"
