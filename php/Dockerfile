FROM php:8.2-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpng-dev libjpeg-dev libwebp-dev libjpeg62-turbo-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    # && docker-php-ext-install gd \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install gd
    

WORKDIR /var/www/symfony_docker

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
RUN git config --global user.email "poczta@sebastianpluta.pl" \ 
    && git config --global user.name "Sebastian Pluta"