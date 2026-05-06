FROM node:22-alpine AS assets

WORKDIR /app

# Compilation des assets front-end dans une etape separee.
COPY package.json package-lock.json vite.config.js postcss.config.js tailwind.config.js ./
COPY resources ./resources

RUN npm ci && npm run build

FROM php:8.4-fpm-alpine AS app

WORKDIR /var/www/html

# Installation des extensions PHP requises par Laravel, MySQL et MongoDB.
RUN apk add --no-cache \
        git \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
        unzip \
    && docker-php-ext-install \
        intl \
        mbstring \
        opcache \
        pdo_mysql \
        zip \
    && apk add --no-cache --virtual .mongodb-build-deps $PHPIZE_DEPS openssl-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && apk del .mongodb-build-deps

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

# Installation des dependances PHP sans les paquets de developpement.
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .
COPY --from=assets /app/public/build ./public/build
COPY docker/php/entrypoint.sh /usr/local/bin/woofland-entrypoint

# Preparation des repertoires accessibles en ecriture par le processus applicatif.
RUN composer dump-autoload --optimize \
    && chmod +x /usr/local/bin/woofland-entrypoint \
    && chown -R www-data:www-data storage bootstrap/cache \
    && mkdir -p public/uploads \
    && chown -R www-data:www-data storage bootstrap/cache public/uploads \
    && chmod -R ug+rw storage bootstrap/cache public/uploads

EXPOSE 9000

ENTRYPOINT ["woofland-entrypoint"]
CMD ["php-fpm"]
