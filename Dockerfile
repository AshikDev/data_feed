# Use a base image with PHP 8.2
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
        libpq-dev \
        libzip-dev \
        libicu-dev \
        libxml2-dev \
        libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        zip \
        opcache \
        ctype \
        iconv \
        intl \
        xml

# Set the working directory in the container
WORKDIR /app

# Copy the Composer JSON and lock files
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the application code to the container
COPY . .

# Finish composer installation
RUN composer dump-autoload --optimize

# Set the entry point for the Symfony console
ENTRYPOINT ["php", "bin/console"]

# Default command (can be overridden)
CMD ["list"]
