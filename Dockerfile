FROM php:8.3-fpm-alpine

# Install system dependencies & PHP extensions yang dibutuhkan Laravel 12
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    linux-headers

RUN docker-php-ext-install pdo_mysql bcmath

# 🔴 TAMBAHKAN BARIS INI (Buat folder runtime untuk Unix Socket & berikan izin akses)
RUN mkdir -p /run/nginx /var/log/nginx \
    && chown -R www-data:www-data /run /var/log/nginx

# Configure Nginx & Supervisor
COPY .docker/nginx.conf /etc/nginx/nginx.conf
COPY .docker/supervisor.ini /etc/supervisor.d/supervisor.ini

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer dan optimasi autoloader untuk production
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Atur permission folder storage & cache agar Laravel bisa menulis log/session
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Berikan izin eksekusi pada script entrypoint
RUN chmod +x /var/www/html/entrypoint.sh

# Buka port 8080 untuk Railway
EXPOSE 8080

# Jalankan script entrypoint untuk handle cache, migrasi, dan start server
ENTRYPOINT ["/var/www/html/entrypoint.sh"]