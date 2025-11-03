FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libintl-dev \
    icu-devtools \
    libicu-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/user user
RUN mkdir -p /home/user/.composer && \
    chown -R user:user /home/user

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=user:user . /var/www

# Change current user to user
USER user

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm ci && npm run build

# Change back to root for final setup
USER root

# Install Apache and enable mod_rewrite
RUN apt-get update && apt-get install -y apache2
RUN a2enmod rewrite
RUN a2enmod headers

# Configure Apache
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2ctl", "-D", "FOREGROUND"]
