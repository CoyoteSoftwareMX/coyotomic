FROM php:8.1-fpm

# Install required zip extension 
RUN apt-get -y update \
    && apt-get install -y zip \
    && apt-get install -y nodejs

RUN apt-get install -y npm 
RUN npm install --global yarn

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
  && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer
