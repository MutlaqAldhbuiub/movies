# Start with a base image containing PHP
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

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
RUN apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

# Node.js, NPM, Yarn
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install npm@latest -g \
    && npm install yarn -g

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Switch to www-data user
USER www-data

# What's the version of composer?
RUN composer --version

# setup laravel
# RUN composer install
RUN npm install
RUN npm run build
RUN php artisan config:cache \
    && php artisan optimize:clear \
    && php artisan cache:clear \
    && php artisan view:clear \
    && php artisan storage:link

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
