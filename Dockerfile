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

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor.d/supervisor.ini"]