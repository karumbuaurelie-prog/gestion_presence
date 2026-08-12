FROM php:8.2-apache

# Installer mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Forcer Apache à utiliser mpm_prefork et pas mpm_event
RUN sed -i 's/mpm_event/mpm_prefork/g' /etc/apache2/apache2.conf

COPY . /var/www/html/

EXPOSE 80
