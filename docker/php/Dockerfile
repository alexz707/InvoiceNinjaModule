FROM php:8.0-cli
RUN apt-get -y update \
&& apt-get install -y libicu-dev zip libzip-dev golang\
&& apt-get install --no-install-recommends --assume-yes --quiet ca-certificates sendmail git \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl \
&& docker-php-ext-configure zip \
&& docker-php-ext-install zip \
&& pecl install xdebug-3.0.0 \
&& docker-php-ext-enable xdebug \
&& go get github.com/mailhog/mhsendmail \
&& cp /root/go/bin/mhsendmail /usr/bin/mhsendmail \
&& echo 'sendmail_path = /usr/bin/mhsendmail --smtp-addr mailhog:1025' > /usr/local/etc/php/conf.d/mailhog.ini

COPY custom.ini "/usr/local/etc/php/conf.d/"