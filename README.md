LaraGit
===============

**Laragit** is a snippets web app built with Laravel and VueJS as a takeoff of a [screencast on Laracasts.com](https://laracasts.com/series/how-do-i/episodes/13)
**LaraGit** has many features like : 
* A user's system
* A Like system.
* and much more is coming


# Installation
## Downloading the files
You can clone this repo using git with:

`git clone https://github.com/rsm23/laragit.git`

Or you can download the zip file.

## Installing packages and dependencies
To install **LaraGit** run these commands :

###PHP Dependencies
`composer install
php artisan key:generate`

###Node Modules
`npm install` or simply `yarn` if you have yarn on your machine

###Database
First setup your database connections on the _**.env**_ file:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laragit
    DB_USERNAME=root
    DB_PASSWORD=
    
Then run

`php artisan migrate`


Now enjoy using **LaraGit**

##Thanks for using my script
Please don't miss to share, pull if you have any optimizations, and submit issues

## Security

If you discover a security vulnerability within this package, please send an e-mail to Rahmani Saif at saiflacrimosa@gmail.com. All security vulnerabilities will be promptly addressed.


## License

LaraGit is licensed under [The MIT License (MIT)](LICENSE).
