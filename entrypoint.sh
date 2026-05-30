#!/bin/sh

# Bersihkan Cache Laravel
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Jalankan Database Migration
php artisan migrate --force

# Nyalakan Web Server (Nginx & PHP-FPM via Supervisor)
exec /usr/bin/supervisord -c /etc/supervisor.d/supervisor.ini