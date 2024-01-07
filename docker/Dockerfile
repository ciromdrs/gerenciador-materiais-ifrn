FROM ubuntu:22.04

# Update package information
RUN apt update -y


# Install PHP
RUN DEBIAN_FRONTEND=noninteractive apt install -y \
    php-common \
    libapache2-mod-php \
    php-cli \
    php-curl \
    php-xml \
    php-mbstring \
    php-xdebug \
    unzip \
    7zip


# Install Composer
WORKDIR /tmp
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer


# Install SQLite
RUN apt install -y sqlite3 php-sqlite3


# Install node
RUN apt install -y nodejs

WORKDIR /app


# Create database file
RUN sqlite3 database/database.db


# Expose Laravel port
EXPOSE 8000


ENTRYPOINT ["bash"]
