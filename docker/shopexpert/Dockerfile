FROM centos:7

LABEL maintainer 'Lucas Awade'

RUN yum -y update

RUN yum -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
RUN yum -y install https://rpms.remirepo.net/enterprise/remi-release-7.rpm

RUN yum -y install yum-utils
RUN yum-config-manager --disable 'remi-php*'
RUN yum-config-manager --enable remi-php74

RUN yum -y update

RUN yum -y install curl git epel-release vim libpq-dev \
    php php-cli php-common php-opcache php-mcrypt \ 
    php-cli php-gd php-curl php-pgsql php-fpm \ 
    php-json php-mbstring php-phar php-openssl \
    php-tokenizer php-xml php-session php-dom \
    php-xmlwriter php-fileinfo php-pdo php-iconv \
    postgresql-dev php-pdo_pgsql

RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN alias composer='/usr/local/bin/composer'

WORKDIR /var/www/html
RUN git clone https://github.com/LAwade/shopexpert.git

WORKDIR /var/www/html/shopexpert
RUN mkdir storage
RUN mkdir storage/logs

EXPOSE 80

ENTRYPOINT [ "php" ]

CMD ["-S", "0.0.0.0:80", "-t", "/var/www/html/shopexpert"]

## docker build -t shopexpert .
## docker run -it -d --name shopexpert -p 8081:80 shopexpert