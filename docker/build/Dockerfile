FROM serversideup/php:8.2-fpm-nginx-alpine

WORKDIR /var/www/html

USER root

#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-interaction --prefer-dist

#COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

#RUN mkdir -p /var/log/nginx && chown -R www-data:www-data /var/log/nginx

#EXPOSE 80

#CMD nginx -g "daemon off;" & php-fpm -F

#HEALTHCHECK --interval=30s --timeout=10s --retries=3 CMD curl --silent --fail http://localhost/ || exit 1
