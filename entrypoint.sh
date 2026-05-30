#!/bin/sh

# Bersihkan Cache Laravel
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Jalankan Database Migration
php artisan migrate --force

# Paksa Laravel jalan langsung di port 8080 tanpa Nginx
exec php artisan serve --host=0.0.0.0 --port=8080