FROM php:7-fpm

# Install modules
RUN apt-get update; \
    apt-get install -y \
        libmcrypt-dev \
        zlib1g-dev \
        curl \
        wget \
        git \
        zlib1g-dev \
        libpng-dev \
        gnupg \
        gnupg2 \
        gnupg1

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install gd
#RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install zip

# Possible values for docker-php-ext-install:
# bcmath bz2 calendar ctype curl dba dom enchant exif fileinfo filter ftp gd
# gettext gmp hash iconv imap interbase intl json ldap mbstring mcrypt mssql
# mysql mysqli oci8 odbc opcache pcntl pdo pdo_dblib pdo_firebird pdo_mysql
# pdo_oci pdo_odbc pdo_pgsql pdo_sqlite pgsql phar posix pspell readline recode
# reflection session shmop simplexml snmp soap sockets spl standard sybase_ct sysvmsg
# sysvsem sysvshm tidy tokenizer wddx xml xmlreader xmlrpc xmlwriter xsl zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list
RUN apt-get update
RUN apt-get install -y nodejs yarn

# Install dockerize. Needed to make php container wait for services it depends on.
# Using wget instead of ADD command to utilize docker cache
ENV DOCKERIZE_VERSION v0.3.0
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz
    
ENV TERM xterm

# This directive is used to prevent permission issues when using shared volumes. Do not use in production!
RUN adduser www-data root