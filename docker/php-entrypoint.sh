#!/bin/bash
echo "Ждем MySQL..."
until php -r "new PDO('mysql:host=mysql;dbname=blog_test', 'root', 'root');" >/dev/null 2>&1; do
    sleep 2
done

echo "MySQL готов, запускаем seed..."
php /var/www/seed.php

php-fpm