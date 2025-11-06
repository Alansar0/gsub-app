# Stage 1: Build with Composer
FROM composer:2 AS build

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist

COPY . .
RUN composer dump-autoload --optimize


# Stage 2: Production image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy built app from previous stage
COPY --from=build /app /var/www/html

# Copy Nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Make sure Nginx listens on Render's provided port
RUN sed -i "s/listen 80;/listen ${PORT:-8080};/" /etc/nginx/conf.d/default.conf

# Expose the Render port (default 8080)
EXPOSE 8080

# Start Nginx and PHP-FPM together
CMD service nginx start && php-fpm
