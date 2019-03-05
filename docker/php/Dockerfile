FROM php:7.2-fpm

RUN apt-get update -q -y \
    && apt-get install -q -y --no-install-recommends \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    libmcrypt-dev \
    unzip \
    git \
    supervisor \
    procps \
    sudo \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update -q -y \
    && apt-get install -q -y --no-install-recommends \
    psmisc

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql\
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

ADD php-fpm.ini /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
