FROM composer:latest AS composer
FROM php:8.1.13-fpm

RUN apt-get update && \
    apt-get install -y \
        curl \
        libpq-dev \
        libfreetype-dev \
        libjpeg62-turbo-dev \
        libwebp-dev \
        libmagickwand-dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install -j$(nproc) gd pdo pgsql pdo_pgsql
RUN pecl install imagick && \
    docker-php-ext-enable imagick
ADD ./dockerfile/php/php.ini /usr/local/etc/php/php.ini

RUN mkdir -p /var/www/app

WORKDIR /var/www/app/

COPY www/node_modules /var/www/app/node_modules/
COPY www/vendor /var/www/app/vendor/

RUN chmod 777 -R /var/www/app/
