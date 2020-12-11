FROM php:7-fpm-alpine
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN apk update && apk add build-base
WORKDIR /usr/share/nginx/html/www
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zlib; exit 0
RUN cp /usr/src/php/ext/zlib/config0.m4 /usr/src/php/ext/zlib/config.m4

RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install xdebug-2.8.1
RUN docker-php-ext-enable xdebug
#RUN apk add php7-zip composer
RUN apk add --no-cache zip libzip-dev
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip