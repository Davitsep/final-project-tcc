# Menggunakan image PHP 7.4 dengan Apache
FROM php:7.4-apache

# Install apt-utils
RUN apt-get update && apt-get install -y --no-install-recommends apt-utils

# Menyalin seluruh konten proyek ke direktori /var/www/html di dalam container
COPY . /var/www/html

# Melakukan update dan menginstall paket yang dibutuhkan (git dan unzip)
RUN apt-get update && apt-get install -y git unzip

# Menjalankan perintah-perintah setelah proses build container
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Mengatur working directory ke /var/www/html di dalam container
WORKDIR /var/www/html

# Mengexpose port 80 (port default Apache)
EXPOSE 8080

# Menjalankan perintah untuk menjalankan server Apache saat container dijalankan
CMD ["apache2-foreground"]
