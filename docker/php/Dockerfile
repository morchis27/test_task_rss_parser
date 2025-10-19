FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    unzip \
    libonig-dev \
    libpq-dev \
    libzip-dev \
    supervisor

RUN docker-php-ext-install -j$(nproc) mbstring pgsql pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN composer global require phpunit/phpunit

COPY app.conf /etc/supervisor/conf.d/app.conf
COPY supervisord.conf /etc/supervisor/supervisord.conf

WORKDIR /var/www/html

COPY init_script.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

EXPOSE 9000
