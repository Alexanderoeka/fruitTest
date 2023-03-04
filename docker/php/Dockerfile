FROM php:8.2.0-fpm

WORKDIR /app/api

#RUN apt-get update && apt-get install -y \
#        git \
#        curl \
#        zip \
#        unzip

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev && \
    pecl install apcu && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql && \
    docker-php-ext-enable apcu pdo_pgsql sodium && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*




RUN pecl install xdebug \
    && docker-php-ext-enable xdebug



COPY docker/php/xdebug.ini "${PHP_INI_DIR}/conf.d"

EXPOSE 9000
