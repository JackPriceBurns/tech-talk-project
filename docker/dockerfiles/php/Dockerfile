FROM php:7.4-fpm

RUN apt-get update && apt-get -y install git zip unzip

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
