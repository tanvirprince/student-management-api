# Use the official PHP 8.3 image with FPM and Alpine Linux
FROM php:8.3-fpm-alpine

# Set the working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
# We install git and other necessary tools
RUN apk add --no-cache \
    git \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd exif bcmath intl

# Clear cache and clean up
RUN rm -rf /var/cache/apk/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Copy all application code
COPY . .

# Ensure storage and bootstrap/cache directories exist
RUN mkdir -p storage/logs bootstrap/cache

# Install Composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader || cat /var/www/html/storage/logs/laravel.log

# Adjust file permissions for storage and bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
