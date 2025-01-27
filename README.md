## Table of Contents
* <strong>Overview</strong>
    * <strong>Backend Setup and Run Instructions 

## Backend Setup and Run Instructions
  * Ensure you have the following installed and added to your system's PATH before proceeding:
    * PHP: Version 8.0 or above (check version using ```php -v```)
    * Composer: Dependency manager for PHP
    * MySQL: Ensure you have a MySQL server running locally or on a remote server
    * git: You can download Git from https://git-scm.com/downloads
  * Clone the Repository
    * ```git clone <repository_url>```
    * ```cd <backend_folder_name>```
  * Install PHP dependencies using Composer:
    * ```composer install```
  * Set Up Environment Variables
    * Copy the example .env.example file to .env: ```cp .env.example .env```
    * Open the .env file and configure the following:
    * *Note: If DB_CONNECTION=sqlite is set by default, replace it with DB_CONNECTION=mysql*
    > * DB_CONNECTION=mysql
    > * DB_HOST=127.0.0.1
    > * DB_PORT=3306
    > * DB_DATABASE=<your_database_name>
    > * DB_USERNAME=<your_database_username>
    > * DB_PASSWORD=<your_database_password>
    * Replace <your_database_name>, <your_database_username>, and <your_database_password> with your MySQL credentials

  * Import the Database
    * Open your MySQL client (e.g., phpMyAdmin, MySQL Workbench, or terminal)
    * Create a new database: ```CREATE DATABASE <your_database_name>;```
    * *Note: It is recommended to use `the sql dump file name` as the database name to avoid potential configuration issues*
    * Import the SQL dump file:```mysql -u <your_database_username> -p <your_database_name> < /path/to/exported_database.sql```
    * *Note: Using < for file redirection in PowerShell results in a error, make sure you use cmd*
    * Replace /path/to/exported_database.sql with the actual path to the SQL file
  * Start the Laravel development server: ```php artisan serve```
    * The application will be accessible at http://127.0.0.1:8000