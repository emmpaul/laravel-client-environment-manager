FROM php:8.2-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    npm \
    nginx \
    && docker-php-ext-install zip pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN npm install && npm run build

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www/html /etc/nginx && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

RUN mkdir -p /var/log/nginx && chown -R www-data:www-data /var/log/nginx

EXPOSE 80

CMD nginx -g "daemon off;" & php-fpm -F

HEALTHCHECK --interval=30s --timeout=10s --retries=3 CMD curl --silent --fail http://localhost/ || exit 1
