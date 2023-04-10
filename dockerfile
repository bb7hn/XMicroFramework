FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    netcat \
    && docker-php-ext-install pdo pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug pdo_mysql \
    && a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
