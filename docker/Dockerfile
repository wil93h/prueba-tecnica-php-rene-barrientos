# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Configurar el entorno de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY . .

# Instalar extensiones necesarias de PHP
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80

# Comando para ejecutar Apache en el contenedor
CMD ["apache2-foreground"]