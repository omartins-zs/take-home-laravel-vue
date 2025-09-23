#!/bin/sh

echo "Esperando o MySQL ficar disponível..."
until mysql -h db -u root -proot -e "select 1" >/dev/null 2>&1; do
  sleep 2
done

echo "MySQL está pronto!"

composer install
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8081
