#!/bin/bash

echo "Building Containers"
docker compose up -d
sleep 2

echo "Building Application"
npm install
composer install
yes | php artisan migrate

echo "Running Application"
composer run dev

echo "Application Running for Dev!"