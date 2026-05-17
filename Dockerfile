FROM php:8.2-apache

# 1. Instala o driver do Postgres (essencial para sumir o erro de driver)
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Habilita o mod_rewrite do Apache (comum em projetos PHP)
RUN a2enmod rewrite

# 3. Define o diretório de trabalho
WORKDIR /var/www/html

# 4. Copia TUDO da sua pasta local para dentro do servidor
COPY . .

# 5. Dá permissão total para o Apache ler os arquivos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80