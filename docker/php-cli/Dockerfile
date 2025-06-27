FROM serversideup/php:8.4-cli-alpine

ENV PHP_OPCACHE_ENABLE=1 \
    APP_BASE_DIR="/var/www/html/public" \
    SSL_MODE="mixed"

USER root

RUN apk update && apk add --no-cache \
    nodejs npm openssl nano zip unzip git curl \
    libpng-dev libxml2-dev postgresql-dev oniguruma-dev

RUN docker-php-ext-configure pgsql && \
    docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath intl sockets soap

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk del $PHPIZE_DEPS && \
    rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

COPY --chown=www-data:www-data . /var/www/html

USER www-data

RUN composer install -v --optimize-autoloader --no-dev

USER root

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data

WORKDIR /var/www/html

RUN php artisan schedule:interrupt