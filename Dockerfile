# Start with a base image containing PHP
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
COPY ./composer.lock ./composer.json /var/www/html/
COPY . /var/www/html/

# Install system dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        build-essential \
        zlib1g-dev \
        default-mysql-client \
        curl \
        gnupg \
        procps \
        vim \
        git \
        unzip \
        libzip-dev \
        libpq-dev \
        libicu-dev \
        libpng-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd intl

# Node.js, NPM, Yarn
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install npm@latest -g \
    && npm install yarn -g

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Switch to www-data user
USER www-data

# Install Laravel installer
RUN composer global require "laravel/installer"

# setup laravel
RUN composer install \
    && npm install \
    && npm run build \
    && php artisan config:cache \
    && php artisan optimize:clear \
    && php artisan cache:clear \
    && php artisan view:clear \
    && php artisan storage:link

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
