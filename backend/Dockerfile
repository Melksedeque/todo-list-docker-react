FROM php:8.3-cli
RUN docker-php-ext-install pdo_mysql
WORKDIR /var/www/html
COPY . .
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]