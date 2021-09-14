FROM php:7.3-fpm
RUN apt-get update && apt-get install libmcrypt-dev -y
RUN apt-get install zlib1g-dev libzip-dev unzip -y
RUN docker-php-ext-install mysqli pdo pdo_mysql zip
RUN pecl install mcrypt && docker-php-ext-enable mcrypt
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /usr/src/asp-test