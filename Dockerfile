# Use official PHP image with Apache
FROM php:8.3-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy the current directory contents into the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80
