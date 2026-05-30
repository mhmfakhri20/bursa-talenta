FROM php:8.3-cli-alpine

RUN apk add --no-cache \
    curl \
    unzip \
    zip \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    linux-headers

RUN docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN composer install --no-dev --no-scripts --optimize-autoloader

COPY . .

RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi \
    && chmod -R 775 storage bootstrap/cache

ENV PORT=8080

EXPOSE 8080

CMD ["sh", "-c", "echo '=== STARTING LARAVEL ON RAILWAY ===' && echo PORT=$PORT && php -v && php artisan --version && php artisan config:clear && php artisan route:clear && php artisan view:clear && echo '=== RUNNING SERVER NOW ===' && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]