FROM serversideup/php:8.2-fpm-nginx-alpine

WORKDIR /var/www/html

USER root

RUN apk add --no-cache nodejs npm

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN npm install

RUN npm run build

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data
