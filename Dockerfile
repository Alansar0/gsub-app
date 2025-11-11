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

# Copy nginx template and start script (start.sh will substitute the port at runtime)
COPY nginx.conf /etc/nginx/conf.d/default.conf.template
COPY start.sh /start.sh
RUN chmod +x /start.sh

WORKDIR /var/www/html

# Ensure Laravel directories have correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache || true

# Informational expose; Render provides PORT at runtime and docker-compose uses environment to pass it
EXPOSE 8080

# Use start script that will:
# - substitute the runtime PORT into nginx config
# - ensure php-fpm listens on TCP 127.0.0.1:9000
# - start php-fpm and nginx (nginx in foreground)
CMD ["/start.sh"]