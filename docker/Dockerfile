FROM php:8.1-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar el módulo rewrite de Apache
RUN a2enmod rewrite

# Copiar el archivo de configuración de Apache
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html/

# Cambiar la propiedad de los archivos a www-data
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias de Composer
RUN composer install --no-interaction --optimize-autoloader

# Mover la carpeta `vendor` fuera del volumen montado
RUN mv vendor /tmp/vendor

# Usar CMD para restaurar la carpeta `vendor` cuando el contenedor inicie
CMD cp -a /tmp/vendor /var/www/html/vendor && apache2-foreground