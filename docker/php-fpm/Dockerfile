ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

RUN apt-get update && \
  apt-get upgrade -y && \
  apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd

RUN set -xe; \
    apt-get update -yqq && \
    pecl channel-update pecl.php.net && \
    apt-get install -yqq \
      apt-utils \
      libzip-dev zip unzip && \
      docker-php-ext-configure zip --with-libzip && \
      docker-php-ext-install zip && \
      php -m | grep -q 'zip'

###########################################################################
# Mysqli Modifications:
###########################################################################

RUN docker-php-ext-install mysqli

###########################################################################
# ImageMagick:
###########################################################################

USER root

RUN apt-get install -y libmagickwand-dev imagemagick && \
    pecl install imagick && \
    docker-php-ext-enable imagick

###########################################################################
# Phalcon:
###########################################################################

ARG PHALCON_VERSION
ENV PHALCON_VERSION ${PHALCON_VERSION}

# Copy phalcon configration
COPY ./phalcon.ini /usr/local/etc/php/conf.d/phalcon.ini.disable

RUN apt-get update && apt-get install -y unzip libpcre3-dev gcc make re2c \
    && curl -L -o /tmp/cphalcon.zip https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.zip \
    && unzip -d /tmp/ /tmp/cphalcon.zip \
    && cd /tmp/cphalcon-${PHALCON_VERSION}/build \
    && ./install \
    && mv /usr/local/etc/php/conf.d/phalcon.ini.disable /usr/local/etc/php/conf.d/phalcon.ini \
    && rm -rf /tmp/cphalcon*

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

USER root

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
