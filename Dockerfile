# Gunakan image PHP sebagai dasar
FROM php:latest

# Set folder kerja di dalam container
WORKDIR /var/www/html

# Salin file-filenya ke folder kerja di dalam container
COPY . /var/www/html

# Expose port yang digunakan oleh aplikasi PHP
EXPOSE 80

# Perintah untuk menjalankan server PHP (misalnya Apache)
CMD ["php", "-S", "0.0.0.0:80"]