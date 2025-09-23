FROM php:8.2-cli

# Instalar dependências básicas + netcat
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    netcat-openbsd \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

EXPOSE 8000

CMD sh -c "composer install --no-interaction --optimize-autoloader && php artisan migrate && php artisan serve --host=0.0.0.0 --port=8000"
