### iCargoMerchant BACKEND

## About the Project

iCargoMerchant Backend, this project uses laravel as an api and mariaDB for database.

The Controller Folder is where all the functions that includes query and codes are store. 

The .ENV file is where all the configuration of backend folder stored.

The Model folder is where all the Models from the Database store, if the developer uses a Eloquent Model

The Routes/api.php is where all the API ENDPOINT stored.

To check all the API Endpoints in backend, the developers uses POSTMAN to test it.

This Project uses Laravel 8 version. 


## COMMANDS TO RUN THIS BACKEND PROJECT


Install composer in https://getcomposer.org/download/

Make sure you have XAMPP Install and PHP7.1 > PHP 8.0 version. 

Once installed, clone the repository by running this COMMANDS

On your folder, git clone RepoLink 

Example : git clone https://github.com/fambaridz/iCargoMerchant.git

This would get the main branch

If you would like to get only the backend branch, run this COMMAND

git clone -b [branch-name] RepoLink
Example : git clone -b be/branchpractice https://github.com/fambaridz/iCargoMerchant.git

once cloned, run composer update or install

Example : Composer update 

if not working

Example : composer install

This would generate the vendor where all the modules and function stored. 

Then make sure that you create a .env file on the Project folder

run this command 
Example : cp .env.example .env

Then run key generate for the project folder APP_KEY

run this command
Example: php artisan key:generate

Note: You will in your .env file that there will be a random APP_KEY generated

then configure your Database and Other keys in the .env file


## BASIC COMMAND IN LARAVEL DEVELOPMENT

php artisan serve - this would serve the development server for this project

php artisan route:list - this would display all the routes in this project

php artisan optimize - this would help you to clear all the caches, routes etc.

php artisan make:controller - this would help you to create controller faster

php artisan make:model - this would help you to create model faster

Other commands where available in internet but these are the basic commands in laravel.

## LARAVEL GUIDE

This site is the official documentation of laravel framework.

Site : https://laravel.com/docs/8.x/installation

Do visit stackoverflow, video tutorials and other forums that would help you to guide on how the laravel works.





