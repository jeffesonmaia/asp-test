FROM php:7.4-fpm
RUN apt-get update
RUN apt-get install libmcrypt-dev -y
RUN apt-get install zlib1g-dev libzip-dev unzip -y
RUN docker-php-ext-install mysqli pdo pdo_mysql zip
RUN pecl install mcrypt
RUN docker-php-ext-enable mcrypt
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /usr/src/asp-tes
COPY . /usr/src/asp-tes
RUN chmod +x ASP-TEST