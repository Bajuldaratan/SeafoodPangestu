FROM php:8.2-apache

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Create startup script
RUN echo '#!/bin/bash\n\
sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf\n\
sed -i "s/:80/:${PORT:-80}/g" /etc/apache2/sites-enabled/*.conf\n\
apache2-foreground' > /start.sh && chmod +x /start.sh

# Expose port
EXPOSE ${PORT:-80}

# Start Apache dengan port dynamic
CMD ["/start.sh"]
