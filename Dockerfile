# Use the PHP 8.3 FPM base image
FROM php:8.3-fpm

# Copy PHP configuration files
COPY ./php/local.ini /usr/local/etc/php/conf.d/local.ini
COPY ./php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Set the working directory
WORKDIR /var/www/html

# Install system dependencies and tools
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libfreetype6-dev \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    libicu-dev \
    locales \
    vim \
    nano \
    zip \
    unzip \
    libzip-dev \
    git \
    curl \
    gnupg \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install gd
RUN docker-php-ext-configure intl 
RUN docker-php-ext-install intl

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add a user for the Laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Adjust directory ownership and permissions
RUN chown -R www:www /var/www/html
RUN chmod -R 755 /var/www/html

# Switch to the www user
USER www

# Copy the application files
COPY ./src /var/www/html/

# Set permissions for Laravel directories
RUN chown -R www:www /var/www/html/
RUN chmod -R 775 /var/www/html/storage
RUN chmod -R 775 /var/www/html/bootstrap/

# Change the working directory to the application root
WORKDIR /var/www/html

# Install PHP and Node.js dependencies
RUN composer install --ignore-platform-reqs
RUN npm install
RUN npm run build

# Setup Laravel environment
RUN php artisan config:cache
RUN php artisan optimize:clear
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan storage:link

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000

CMD ["php-fpm"]
