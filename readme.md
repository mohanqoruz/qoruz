## Qoruz API

## Don't run any of these commands from root user ##

## Installation
#### Create a folder using the command.

> mkdir qoruz

> sudo chown ubuntu:ubuntu qoruz


#### Clone Qoruz from github using

> git clone <- git url -> qoruz

#### Install php dependencies

> sudo apt-get install php7.2-gd (change to your php versions)

#### Install Composer
If composer is not installed install composer using

> curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

This will download and install Composer as a system-wide command named composer, under /usr/local/bin

#### Install necessary dependancies
Go to the Qoruz directory using

> cd qoruz

> composer install --no-scripts

#### Product Setup
Create .env file and copy from env example

> cp .env.example .env

Make sure that the bootstrap/cache and storage/ folders are writable.
If not change the permissions accordingly.

> chmod -R 777 bootstrap/cache

> chmod -R 777 storage/

Run following command to generate APP_KEY

> php artisan key:generate

Create a database and update the database connections in .env file
Create the schema using

> php artisan migrate --seed

##### Install passport

> php artisan passport:install
