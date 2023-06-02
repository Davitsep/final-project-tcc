# Stage 1: Build the application
FROM php:7.4-apache as builder

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        curl

# Enable PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache Rewrite module
RUN a2enmod rewrite

# Copy the project files to the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install --no-dev --optimize-autoloader

# Stage 2: Create the final image
FROM php:7.4-apache

# Copy the built application from the builder stage
COPY --from=builder /var/www/html /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Enable Apache Rewrite module
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
