FROM php:7.2-apache

RUN pecl install xdebug-2.6.0 \
    && apt update \
    && apt install -y git zlib1g-dev unzip \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY .docker/config/vhosts/sf4.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/html
