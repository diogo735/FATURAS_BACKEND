FROM php:8.2-apache

# Instalar dependências do sistema necessárias para o pdo_pgsql
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Copiar código para o container
COPY . /var/www/html

# Corrigir o DocumentRoot para apontar para a pasta public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/sites-available/default-ssl.conf

# Ativar mod_rewrite para Laravel
RUN a2enmod rewrite

# Garantir permissões corretas para cache e storage
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html
