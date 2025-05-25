FROM php:8.2-apache

# Installe les extensions nécessaires : mysqli + pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copie les fichiers PHP vers le dossier du serveur
COPY php/www/ /var/www/html/

# Donne les droits au dossier uploads
RUN chmod -R 777 /var/www/html/uploads
RUN chown -R www-data:www-data /var/www/html/uploads


