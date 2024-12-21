FROM serversideup/php:8.2-fpm-nginx-alpine

WORKDIR /var/www/html

USER root

RUN apk add --no-cache nodejs npm

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN npm install

RUN npm run build

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# EXPOSE 80

CMD nginx -g "daemon off;" & php-fpm -F

# HEALTHCHECK --interval=30s --timeout=10s --retries=3 CMD curl --silent --fail http://localhost/ || exit 1

USER www-data
