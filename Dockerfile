FROM php:8.2-fpm

# Instala las extensiones necesarias y Nginx
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libzip-dev \
    nginx \
    && docker-php-ext-install zip pdo_mysql

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos de tu aplicación
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala las dependencias de Composer
RUN composer install --no-dev --no-interaction --prefer-dist

# Copia la configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Ejecuta las migraciones
RUN php artisan migrate --force

# Limpia la caché
RUN php artisan optimize:clear

# Exponer puerto
EXPOSE 80

# Comando de inicio corregido para ejecutar PHP-FPM y Nginx juntos
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
