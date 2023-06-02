# Stage 1: Build frontend assets
FROM node:14 AS frontend-builder
WORKDIR /app/frontend
COPY frontend/package.json frontend/yarn.lock ./
RUN yarn install
COPY frontend .
RUN yarn build

# Stage 2: Build PHP application
FROM php:7.4-apache
WORKDIR /var/www/html
COPY --from=frontend-builder /app/frontend/dist ./frontend
COPY backend .
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]
