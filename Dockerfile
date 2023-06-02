# Gunakan image PHP dengan tag 8.0-apache sebagai dasar
FROM php:8.0-apache

# Salin file-filenya ke folder kerja di dalam container
COPY . /var/www/html

# Expose port yang digunakan oleh aplikasi PHP
EXPOSE 8080

# Konfigurasi server Apache untuk menggunakan port 8080
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Aktifkan modul rewrite di server Apache
RUN a2enmod rewrite

# Perintah untuk menjalankan server Apache pada port 8080
CMD ["apache2ctl", "-D", "FOREGROUND"]
