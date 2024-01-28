FROM ghcr.io/MutlaqAldhbuiub/docker_laravel_base_image:latest

# Set working directory
WORKDIR /var/www/html

# Install dependencies
COPY ./src/composer.lock ./src/composer.json /var/www/html/
COPY ./src /var/www/html/

# set permissions
COPY --chown=www:www ./src /var/www/html/
RUN chown -R www:www /var/www/html/
RUN chmod -R 755 /var/www/html/

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
# EXPOSE 5173

CMD ["php-fpm"]