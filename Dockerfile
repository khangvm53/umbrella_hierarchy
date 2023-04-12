FROM php:8.1-apache

RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql