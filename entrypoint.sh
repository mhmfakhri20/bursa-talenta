#!/bin/sh

# Bersihkan Cache Laravel
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Jalankan Database Migration
php artisan migrate --force

# 🔴 KUNCI UTAMA: Jalankan Supervisor untuk mengontrol Nginx & PHP-FPM secara bersamaan
exec /usr/bin/supervisord -c /etc/supervisor.d/supervisor.ini