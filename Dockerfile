FROM php:7.3-apache
MAINTAINER Hakan Akhan <hakan.akhan@gmail.com>

COPY . /var/www/html
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl \
&& apt-get install -y libzip-dev zip \
&& docker-php-ext-install zip \
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php \
&& php -r "unlink('composer-setup.php');" \
&& mv composer.phar /usr/local/bin/composer \
&& cd /var/www/html \
&& composer install \
&& a2enmod rewrite \
&& service apache2 restart \
&& chmod -R 777 writable

RUN echo "The App has created successfully"
