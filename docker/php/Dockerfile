FROM php:7.4.22-fpm

ARG APP_WORKDIR

#FIX: CVE-2020-36193(Vuln 1.4.11, pre fix 1.4.12, fix 1.4.13, stable 1.4.14, see: https://github.com/advisories/GHSA-rpw6-9xfx-jvcx)
RUN pear install --force pear/Archive_Tar-1.4.14 && pear info Archive_Tar

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    zlib1g-dev \
    libicu-dev \
    unzip \
    libzip-dev \
    zip \
    libpq-dev \
    libxml2-dev

RUN docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) \
        zip \
        intl \
        exif \
        pcntl \
        opcache \
        pgsql \
        pdo_mysql \
        pdo_pgsql \
        sockets \
        soap \
    && docker-php-ext-enable opcache

RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
#RUN pecl install pthreads && docker-php-ext-enable pthreads

COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p $APP_WORKDIR && chmod -R 777 $APP_WORKDIR

WORKDIR $APP_WORKDIR

RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/bin

ENTRYPOINT ["docker-php-entrypoint"]
CMD ["php-fpm"]
