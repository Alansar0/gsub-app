# Stage 1: Build PHP dependencies with Composer
FROM composer:2 AS build

WORKDIR /app
COPY . .
RUN composer install --no-dev --no-interaction --optimize-autoloader
RUN composer dump-autoload --optimize



# Stage 2: Production image
FROM php:8.2-fpm

# Install system packages and extensions
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy application from builder
COPY --from=build /app /var/www/html

# Copy Nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Render dynamic port replacement
RUN sed -i "s/listen 80;/listen ${PORT:-8080};/" /etc/nginx/conf.d/default.conf

# Expose internal port
EXPOSE 8080

# Run PHP-FPM + Nginx together
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Update Nginx to listen on Render’s dynamic port
RUN sed -i "s/listen 80;/listen ${PORT:-8080};/" /etc/nginx/conf.d/default.conf

# Expose Render’s port
EXPOSE 8080

# Start both Nginx and PHP-FPM
CMD service nginx start && php-fpm
