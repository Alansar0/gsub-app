# Stage 1: Build PHP dependencies with Composer
FROM composer:2 AS build

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader
COPY . .
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
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy application from builder
COPY --from=build /app /var/www/html

# nginx template and start script
COPY nginx.conf /etc/nginx/conf.d/default.conf.template
COPY start.sh /start.sh
RUN chmod +x /start.sh

WORKDIR /var/www/html

# Permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache || true

# Expose a conventional port (informational). Render will provide $PORT at runtime.
EXPOSE 8080

# Start script will substitute PORT and run php-fpm + nginx
CMD ["/start.sh"]RUN chown -R www-data:www-data storage bootstrap/cache

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
