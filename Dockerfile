FROM php:8.2-apache

# Copiar todos os ficheiros para o container
COPY . /var/www/html

# Instalar extensões necessárias para o PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Corrigir o DocumentRoot do Apache para apontar para a pasta "public"
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/sites-available/default-ssl.conf

# Ativar o mod_rewrite do Apache (necessário para o Laravel)
RUN a2enmod rewrite

# Dar permissões às pastas necessárias
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html
