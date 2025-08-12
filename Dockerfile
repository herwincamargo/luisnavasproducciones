FROM php:8.3-apache

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar el módulo rewrite de Apache
RUN a2enmod rewrite

# Copiar los archivos de la aplicación al directorio de Apache
COPY luisnavasproducciones/ /var/www/html/

# Establecer los permisos correctos
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Exponer el puerto 80
EXPOSE 80
