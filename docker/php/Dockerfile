FROM php:8.2.0-fpm

WORKDIR /app/api

RUN apt-get update && apt-get install -y \
        git \
        curl \
        zip \
        unzip




RUN pecl install xdebug \
    && docker-php-ext-enable xdebug



COPY docker/php/xdebug.ini "${PHP_INI_DIR}/conf.d"


