FROM php:7.4-cli

LABEL maintainer 'Lucas Awade' 

RUN apt-get update && apt-get install -y curl unzip vim git libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html
RUN git clone https://github.com/LAwade/shopexpert.git

WORKDIR /var/www/html/shopexpert

RUN composer install

EXPOSE 80

ENTRYPOINT [ "php" ]

CMD ["-S", "0.0.0.0:80", "-t", "/var/www/html/shopexpert"]