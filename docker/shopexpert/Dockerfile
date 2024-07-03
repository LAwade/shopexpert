FROM debian

LABEL maintainer 'Lucas Awade'

RUN apt update 
RUN apt -install lsb-release wget vim git apt-transport-https ca-certificates software-properties-common -y

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg 
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
RUN apt -y update

RUN apt install php php8.2-cli php8.2-common php8.2-dev php8.2-gd php8.2-mbstring php8.2-common php8.2-pgsql php8.2-curl

RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN alias composer='/usr/local/bin/composer'

WORKDIR /var/www/html
RUN git clone https://github.com/LAwade/shopexpert.git

WORKDIR /var/www/html/shopexpert

RUN composer install

EXPOSE 80

ENTRYPOINT [ "php" ]

CMD ["-S", "0.0.0.0:80", "-t", "/var/www/html/shopexpert"]