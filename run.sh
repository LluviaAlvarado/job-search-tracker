#!/bin/bash

echo "Building Containers"
docker compose up -d
sleep 2

echo "Building Application"
npm install --omit=dev
composer install --no-dev --optimize-autoloader
\n | php artisan migrate --force

echo "Running Application"
composer run deploy

echo "Application Running!"