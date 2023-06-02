# Menggunakan gambar resmi PHP dengan Apache
FROM php:7.4-apache

# Menyalin konten proyek ke direktori kerja di dalam kontainer
COPY . /var/www/html

# Memperbarui paket yang ada dan menginstal dependensi yang diperlukan
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip

# Menjalankan perintah untuk menginstal dependensi PHP yang diperlukan (misalnya, jika menggunakan Composer)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# Menjalankan perintah untuk menyiapkan konfigurasi Apache
RUN a2enmod rewrite

# Menjalankan Apache ketika kontainer dimulai
CMD apache2-foreground
