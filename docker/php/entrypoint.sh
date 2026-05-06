#!/bin/sh
set -e

mkdir -p storage bootstrap/cache public/uploads
chown -R www-data:www-data storage bootstrap/cache public/uploads
chmod -R ug+rw storage bootstrap/cache public/uploads

exec "$@"
