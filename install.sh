#!/bin/bash
echo Installing Laragit
echo Cloning repo...
git clone https://github.com/rsm23/laragit.git
cd laragit
echo Clone completed. Installing dependencies...
composer install
npm install
echo Dependencies installed.

echo Type of database connection:
read db_connection

echo Database host:
read db_host

echo Database port:
read db_port

echo Database:
read db_database

echo Database username:
read db_username

echo Databse password:
read db_password

touch ./.env
echo DB_CONNECTION=$db_connection >> ./.env
echo DB_HOST=$db_host >> ./.env
echo DB_PORT=$db_port >> ./.env
echo DB_DATABASE=$db_database >> ./.env
echo DB_USERNAME=$db_username >> ./.env
echo DB_PASSWORD=$db_password >> ./.env

echo Successfully installed Lavagit. Enjoy!
