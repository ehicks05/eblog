FROM php:apache

MAINTAINER Eric Hicks

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/app

RUN docker-php-ext-install mbstring mysqli \
    && chown -R www-data:www-data /srv/app \
    && a2enmod rewrite \
