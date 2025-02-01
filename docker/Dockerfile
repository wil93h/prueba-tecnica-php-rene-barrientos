FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN composer install --no-interaction --optimize-autoloader

RUN mv vendor /tmp/vendor

CMD cp -a /tmp/vendor /var/www/html/vendor && apache2-foreground