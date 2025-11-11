#!/bin/sh
set -e

# default to 8080 if PORT isn't provided
: "${PORT:=8080}"

# If template exists, substitute the runtime PORT into default.conf
if [ -f /etc/nginx/conf.d/default.conf.template ]; then
  sed "s/__PORT__/${PORT}/g" /etc/nginx/conf.d/default.conf.template > /etc/nginx/conf.d/default.conf
fi

# Ensure permissions for Laravel storage and cache
if [ -d /var/www/html/storage ]; then
  chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
fi

# Force php-fpm pool to listen on TCP 127.0.0.1:9000 (many php-fpm images default to socket)
if [ -f /usr/local/etc/php-fpm.d/www.conf ]; then
  sed -i 's@^listen = .*@listen = 127.0.0.1:9000@' /usr/local/etc/php-fpm.d/www.conf || true
fi

# Start php-fpm in background (attempt -D, otherwise use foreground and background it)
if command -v php-fpm >/dev/null 2>&1; then
  php-fpm -D 2>/dev/null || php-fpm -F &
elif command -v php-fpm8.2 >/dev/null 2>&1; then
  php-fpm8.2 -D 2>/dev/null || php-fpm8.2 -F &
else
  echo "php-fpm not found in image!"
  exit 1
fi

# Start nginx in foreground
exec nginx -g 'daemon off;'
