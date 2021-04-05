FROM php:7.3-fpm-buster

WORKDIR /var/www/html

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN chown www-data:www-data /var/www/html/
