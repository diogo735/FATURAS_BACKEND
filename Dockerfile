FROM php:8.2-apache

# Instalar dependências do sistema necessárias para o pdo_pgsql
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar o projeto para o container
COPY . /var/www/html

# Ir para a pasta do projeto
WORKDIR /var/www/html

# Instalar dependências do Laravel (depois de copiar o código)
RUN composer install --no-dev --optimize-autoloader

# Corrigir o DocumentRoot para a pasta public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/sites-available/default-ssl.conf

# Ativar mod_rewrite do Apache (Laravel precisa disto)
RUN a2enmod rewrite

# Dar permissões para storage e cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache
