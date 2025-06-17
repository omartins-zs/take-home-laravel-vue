# backend/Dockerfile

FROM php:8.1-cli

# Instala extensões e utilitários
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git \
 && docker-php-ext-install pdo_mysql mbstring xml \
 && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia só composer.json para instalar antes de copiar todo o código
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copia o restante
COPY . .

# Permissões
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

# O comando será sobreposto pelo docker-compose, mas pode deixar o default
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
