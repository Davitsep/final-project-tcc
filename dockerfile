# Menggunakan PHP sebagai base image
FROM php:7.4-apache

# Menyalin kode proyek ke dalam container
COPY . /var/www/html

# Mengatur working directory ke direktori proyek
WORKDIR /var/www/html

# Menginstall dependensi yang diperlukan
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Mengatur konfigurasi Apache
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Menjalankan perintah ketika container dijalankan
CMD apachectl -D FOREGROUND
