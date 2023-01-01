FROM php:7.4-fpm-alpine

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl-dev \
        libtool \
        libxml2-dev \
        oniguruma-dev \
    && apk add --no-cache \
        curl \
        git \
        mysql-client \
        libintl \
        icu \
        icu-dev \
        libzip-dev \
        libgomp \
    && docker-php-ext-install \
        curl \
        mbstring \
        pdo \
        pdo_mysql \
        pcntl \
        tokenizer \
        xml \
        zip \
        intl \
    && pecl install xdebug-3.1.0 \
    && docker-php-ext-enable xdebug \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apk del -f .build-deps

WORKDIR /var/www
