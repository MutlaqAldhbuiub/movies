# Rental project
This is a traning project to learn concepts.

## Requirments:
* PHP 8.2
* Composer
* Nodejs >= 18
* MySQL

## Installation
Kindly setup the requirments for the project which listed in the requirments section.
**Make sure that you have already created a database**
## Regular instllation process
1- Clone the project by the following command 
`git clone https://github.com/MutlaqAldhbuiub/movies`
2- Change the current directory to the project directory
`cd movies`
3- Run composer by run
`composer install`
4- Copy the env example file
`cp .env.example .env`
5- Generate a key for the project
`php artisan key:generate`
6- migrate the table schemas to the database
`php artisan migrate`
7- run the project
`php artisan serve`
8- Go to link `localhost:8000`
