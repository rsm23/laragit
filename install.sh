#!/bin/bash
echo Installing Laragit
echo Cloning repo...
git clone https://github.com/rsm23/laragit.git
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
