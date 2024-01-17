#!/usr/bin/env sh
mkdir -p /var/www/public/uploads
chmod -R 777 /var/www/public/uploads
mkdir -p /var/www/var
chmod -R 777 /var/www/var

set -e

composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

## Symfony configuration
if [ ${APP_ENV} != "prod" ]; then
  php bin/console doctrine:database:drop --force --quiet --if-exists --no-interaction
fi
php bin/console doctrine:database:create --if-not-exists --quiet --no-interaction
php bin/console doctrine:migrations:migrate --verbose --no-interaction --allow-no-migration
if [ ${APP_ENV} != "prod" ]; then
  php bin/console doctrine:fixtures:load --quiet --no-interaction --no-debug
fi

php bin/console cache:clear
php bin/console cache:warmup

# run composer scripts like
# assets:install public
# ckeditor:install and so on
composer update
composer run post-install-cmd

## server config
php-fpm -D &
nginx -g "daemon off;"
