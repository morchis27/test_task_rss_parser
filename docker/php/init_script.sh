#!/bin/sh
set -e

cd /var/www/html

if [ ! -f artisan ]; then
  rm -rf /tmp/laravel
  composer create-project laravel/laravel /tmp/laravel --no-interaction
  cp -R /tmp/laravel/. /var/www/html/
fi

if [ ! -d vendor ]; then
  composer install --no-interaction --prefer-dist
fi

if [ ! -f .env ]; then
  cp .env.example .env
fi
php artisan key:generate --force || true

mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chmod -R ug+rw storage bootstrap/cache || true


if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
  php artisan migrate --force
fi

exec /usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf

