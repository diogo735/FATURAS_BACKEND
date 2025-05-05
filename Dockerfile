# Usa imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões necessárias (pdo, pgsql, zip, etc.)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Copia os arquivos para dentro do container
COPY . /var/www/html/

# Muda o DocumentRoot do Apache para a pasta public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala dependências do projeto
RUN composer install

# Dá permissões corretas para storage e cache
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Habilita o módulo rewrite do Apache (para .htaccess do Laravel)
RUN a2enmod rewrite

# Configura o Apache para apontar para a pasta public
WORKDIR /var/www/html
