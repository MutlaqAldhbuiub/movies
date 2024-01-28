# Movie Rental project
Welcome to the Movie Rental project, a training endeavor aimed at mastering some concepts in web development.

## Requirments:
* PHP 8.2
* Composer
* Nodejs >= 18
* MySQL

## Installation
Ensure that the project requirements are set up as outlined in the Requirements section. Additionally, **make sure you have created a database for the project.**

## Regular Installation Process
1- Clone the project using the following command:
`git clone https://github.com/MutlaqAldhbuiub/movies`

2- Navigate to the project directory:
`cd movies`

3- Install dependencies with Composer:
`composer install`

4- Copy the example environment file:
`cp .env.example .env`

5- Generate a key for the project:
`php artisan key:generate`

6- Migrate the database table schemas:
`php artisan migrate`

7- Run the project:
`php artisan serve`

8- Visit `localhost:8000` in your browser.

#### Admin account
- Username: `admin`
- Password: `password`
