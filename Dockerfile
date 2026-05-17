FROM php:8.2-apache

# Instala dependências do sistema e o driver pdo_pgsql
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/
EXPOSE 80