# Maniak Exercise

## Before Install

Make Sure you have the following software installed:

- GIT
- Composer
- Apache 2.4
- PHP >= 7.1.3
- MySQL >= 8.0

## Installation Instructions

- Download or clone "https://github.com/kadug/thelibrary.git" on your virtual directory
- Open console and then go to the app path and run "Composer install" after cloning the application
- Go to root app path and Rename .env.example to .env
- Go to MySQL and create database for the application and add conection configuration to the ".env" file
- Open console again with the app path and run Command "php artisan key:generate" 
- For the creation of the database tables, open console on the app path and run command "php artisan migrate".
- All done, this app is ready to be use