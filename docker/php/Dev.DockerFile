FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

RUN apk --update add wget \
      curl \
      build-base \
      autoconf \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      libxml2-dev \
      libmemcached-dev \
      cyrus-sasl-dev \
      libgsasl-dev \
      oniguruma-dev \
      pcre-dev \
      zlib-dev \
      #libcrypt-dev \
      openssl-dev \
      openssl \
      zip unzip \
      git && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install postgress
RUN apk add postgresql postgresql-dev \
    && docker-php-ext-install pdo_pgsql pcntl

# Copy files
COPY app            /var/www/app
COPY bootstrap      /var/www/bootstrap
COPY config         /var/www/config
COPY database       /var/www/database
COPY public         /var/www/public
COPY resources      /var/www/resources
COPY routes         /var/www/routes
COPY storage        /var/www/storage
COPY artisan        /var/www/artisan
COPY package.json   /var/www/package.json

COPY composer.*  ./

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

RUN composer install \
      --no-interaction \
      --no-plugins \
      --no-scripts \
      --no-autoloader \
      --prefer-dist

RUN composer dump-autoload  --no-scripts && \
    chown -R www-data:www-data /var/www && \
    chmod 755 -R /var/www && \
    chmod -R 777 /var/www/storage && \
    chmod -R 777 /var/www/bootstrap/cache && \
    chmod -R 777 /var/www/storage/framework
