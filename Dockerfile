FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip sqlite3 libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key
RUN php artisan key:generate --show > /tmp/key && \
    sed -i "s|APP_KEY=.*|APP_KEY=$(cat /tmp/key)|" .env

# Storage symlink
RUN php artisan storage:link || true

# Make database folder
RUN mkdir -p /data && touch /data/database.sqlite

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
