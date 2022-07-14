FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

COPY . .

RUN apk add --no-cache \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        freetype-dev

RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install gd

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install exif

RUN chown -R www-data:www-data /var/www/html
