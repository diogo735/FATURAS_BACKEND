FROM php:8.2-apache

# Instalar dependências PHP e PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    zip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar projeto
COPY . /var/www/html

# Dar permissões
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Ativar rewrite para Laravel
RUN a2enmod rewrite
