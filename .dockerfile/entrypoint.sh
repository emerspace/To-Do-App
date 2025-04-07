#!/bin/bash

cd /var/www

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

until php -r '
    try {
        new PDO("mysql:host=mysql;dbname=todo_app", getenv("DB_USERNAME"), getenv("DB_PASSWORD"));
        exit(0);
    } catch (Exception $e) {
        exit(1);
    }
'; do
    echo "Czekam na MySQL..."
    sleep 2
done

if [ ! -d "vendor" ]; then
    composer install
fi

composer dump-autoload
php artisan config:clear
php artisan cache:clear
php artisan config:cache

if [ -z "$APP_KEY" ] && [ -f ".env" ]; then
    php artisan key:generate
fi

if [ "$RUN_MIGRATIONS" = "true" ]; then
    php artisan migrate:fresh --seed
fi

php artisan queue:work &
php artisan schedule:work &
php artisan serve --host=0.0.0.0 --port=8000