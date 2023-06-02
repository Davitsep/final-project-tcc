# Gunakan base image PHP yang diinginkan
FROM php:7.4-apache

# Setel direktori kerja ke direktori root aplikasi
WORKDIR /var/www/html

# Salin file aplikasi ke dalam kontainer
COPY . .

# Instal dependensi yang dibutuhkan
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Instal composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependensi PHP menggunakan composer
RUN composer install --no-dev --optimize-autoloader

# Konfigurasi Apache
RUN a2enmod rewrite

# Expose port 80
EXPOSE 8080

# Setel command yang akan dijalankan saat kontainer berjalan
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
