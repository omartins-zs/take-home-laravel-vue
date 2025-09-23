#!/bin/sh

composer install --no-interaction --prefer-dist --optimize-autoloader

echo "⏳ Aguardando o MySQL subir..."
./wait-for-it.sh db:3306 -t 60 -- echo "✅ MySQL está pronto!"

php artisan migrate:fresh --seed --force

php artisan serve --host=0.0.0.0 --port=8081
