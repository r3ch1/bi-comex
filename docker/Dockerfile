FROM php:8.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

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
    libssl-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mbstring exif pcntl bcmath pdo_mysql

# RUN pecl install redis; \
#     docker-php-ext-enable redis

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=debug" | tee -a $PHP_INI_DIR/php.ini > /dev/null && \
    echo "xdebug.start_with_request=yes" | tee -a $PHP_INI_DIR/php.ini > /dev/null && \
    echo "xdebug.client_host=host.docker.internal" | tee -a $PHP_INI_DIR/php.ini > /dev/null

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -sS https://getcomposer.org/installer | php; \
    mv composer.phar /usr/local/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user

RUN echo "Access <http://rechi-bi.localhost> to view this project"
