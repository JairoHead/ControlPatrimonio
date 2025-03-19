FROM php:8.2-cli # O la versión de PHP que uses

# Instala las extensiones necesarias
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libzip-dev \
    && docker-php-ext-install zip

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia los archivos de tu aplicación
COPY . /app

# Establece el directorio de trabajo
WORKDIR /app

# Instala las dependencias de Composer
RUN composer install --no-dev

# Ejecuta las migraciones
RUN php artisan migrate --force

# Limpia la cache
RUN php artisan optimize:clear

# Establece el directorio de salida
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=3000"]

EXPOSE 3000
