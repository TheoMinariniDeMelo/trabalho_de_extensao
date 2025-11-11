FROM php:8.3.28RC1-zts-alpine3.22

WORKDIR /app

RUN apk add --no-cache bash curl zip unzip \
    && docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./composer.json ./
COPY ./app ./app
COPY ./core ./core
COPY ./public ./public

RUN composer install || true

EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
