# Start with a base image containing PHP
FROM php:8.2-fpm


# Set working directory
WORKDIR /var/www/html

# Install dependencies
COPY composer.lock composer.json /var/www/html/
COPY . /var/www/html/

# set permissions
COPY --chown=www:www . /var/www/html/
RUN chown -R www:www /var/www/html/
RUN chmod -R 755 /var/www/html/

# Install system dependencies
RUN apt-get update \
  && apt-get install -y build-essential zlib1g-dev default-mysql-client curl gnupg procps vim git unzip libzip-dev libpq-dev \
  && docker-php-ext-install zip pdo_mysql pdo_pgsql pgsql

RUN apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Node.js, NPM, Yarn
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g
RUN npm install yarn -g

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
RUN composer config --global process-timeout 3600
RUN composer global require "laravel/installer"

# Change current user to www
USER www
WORKDIR /var/www/html

# setup laravel
RUN composer install
RUN npm install
RUN npm run build

# RUN npm run dev
RUN php artisan config:cache
RUN php artisan optimize:clear
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan storage:link

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
