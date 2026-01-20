FROM php:8.2-cli

# 1. Instalar utilidades del sistema y librerías para Postgres (Supabase)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Instalar Composer (el gestor de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Configurar carpeta de trabajo
WORKDIR /var/www/html

# 4. Copiar todos tus archivos al servidor
COPY . .

# 5. Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# 6. Exponer el puerto para que Internet lo vea
EXPOSE 8000

# 7. Comando para encender el servidor
CMD php artisan serve --host=0.0.0.0 --port=8000
