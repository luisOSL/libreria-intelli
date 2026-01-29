# Usamos PHP 7.4 con Apache
FROM php:7.4-apache

# Limpiar y reconfigurar repositorios (Bullseye Archive)
RUN echo "deb http://archive.debian.org/debian/ bullseye main" > /etc/apt/sources.list && \
    echo "deb-src http://archive.debian.org/debian/ bullseye main" >> /etc/apt/sources.list && \
    echo "Acquire::Check-Valid-Until \"false\";" > /etc/apt/apt.conf.d/99no-check-valid-until

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y --allow-unauthenticated \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev \
    # Agregamos pdo_mysql para evitar el error de constantes de base de datos
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_sqlite pdo_mysql zip bcmath

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Clonar el repositorio
RUN git clone https://github.com/luisOSL/libreria-intelli.git .

# Configurar Git como directorio seguro
RUN git config --global --add safe.directory /var/www/html

# Preparar archivos de entorno y base de datos
RUN cp .env.example .env && \
    touch database/database.sqlite

# Actualizamos el .env internamente para usar SQLite explícitamente
RUN sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/g' .env && \
    sed -i 's/DB_DATABASE=laravel/DB_DATABASE=\/var\/www\/html\/database\/database.sqlite/g' .env

# Instalar dependencias
RUN composer install --no-interaction --optimize-autoloader --ignore-platform-reqs

# Configurar el DocumentRoot de Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

EXPOSE 80