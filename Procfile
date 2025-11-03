web: vendor/bin/heroku-php-apache2 public/
release: php artisan key:generate --force && php artisan migrate --force && php artisan db:seed --force && php artisan config:cache && php artisan storage:link
