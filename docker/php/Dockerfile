FROM php:7.1-apache

ENV BUILD_DEPS \
    build-essential \
    libicu-dev \
    libldap2-dev \
    libsasl2-dev \
    libxml2-dev \
    libzip-dev \
    zlib1g-dev \
    apache2-dev \
    libssl-dev

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        curl \
        openssh-client \
        npm \
        expect \
        libcurl4-openssl-dev \
        pkg-config \
        libmcrypt-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        beanstalkd \
        optipng \
        jpegoptim \
        libbz2-dev \
        $BUILD_DEPS \
    && apt-mark manual \
        'libicu[0-9][0-9]' \
        'libzip[0-9]' \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        calendar \
        intl \
        opcache \
        pdo_mysql \
        soap \
        zip \
        mcrypt \
        exif \
        mysqli \
        gd \
        bz2

RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
RUN apt-get update && apt-get install -y \
		nodejs \
		nano \
        zsh

RUN curl -fsSL 'https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh'

RUN yes | pecl install apcu apcu_bc-beta \
    && docker-php-ext-enable apcu

RUN yes | pecl install xdebug

RUN apt-get install libzmq3-dev -y --no-install-recommends

RUN pecl install zmq-beta

RUN curl -L 'https://phar.phpunit.de/phpunit.phar' -o /usr/local/bin/phpunit \
    && chmod +x /usr/local/bin/phpunit
RUN curl -L 'https://getcomposer.org/installer' -o /tmp/composer-setup.php \
    && php /tmp/composer-setup.php -- --install-dir=/usr/local/bin --filename=composer \
    && rm /tmp/composer-setup.php

RUN mkdir /var/www/.composer
RUN chown www-data /var/www/.composer
RUN chmod -R 775 /var/www/.composer

RUN a2enmod rewrite
RUN a2enmod proxy
RUN a2enmod proxy_wstunnel
RUN a2enmod proxy_http
RUN a2enmod proxy_balancer
RUN a2enmod lbmethod_byrequests

COPY php.ini /usr/local/etc/php/conf.d/php.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY headers.conf /etc/apache2/mods-enabled/headers.conf
RUN ln -s /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/headers.load

RUN echo '#!/bin/bash\n([ -f bin/console ] && php bin/console $*) || php app/console $*' > /usr/bin/dev
RUN chmod +x /usr/bin/dev
RUN echo '#!/bin/bash\n([ -f bin/console ] && php bin/console --env=prod $*) || php app/console --env=prod $*' > /usr/bin/prod
RUN chmod +x /usr/bin/prod


RUN docker-php-ext-enable xdebug
RUN echo "xdebug.remote_host=$DOCKER_HOST" > /usr/local/etc/php/conf.d/xdebug-host.ini
RUN echo "xdebug.remote_host_tmp=$DOCKER_HOST" > /usr/local/etc/php/conf.d/xdebug-host.ini
RUN npm install -g bower
RUN npm install -g gulp
RUN npm install -g gulp-cli
RUN npm install -g gulp-sass
RUN npm install node-sass

COPY ./vhost-config.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
EXPOSE 443
EXPOSE 8080

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

RUN zsh