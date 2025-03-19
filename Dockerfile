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
RUN composer install --no-dev

# Copia la configuración de Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Ejecuta las migraciones
RUN php artisan migrate --force

# Limpia la cache
RUN php artisan optimize:clear

# Inicia Nginx y PHP-FPM
CMD ["nginx", "-g", "daemon off;", "&&", "php-fpm"]

EXPOSE 80
RUN service php8.2-fpm status
RUN ls -l /run/php/
RUN nginx -t
