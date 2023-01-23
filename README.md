## System
The project is based on the design pattern repository system and HMVC

## Installation

Clone Repository

`git clone https://github.com/OmarTarekAbbas/syaaraat`

Move to the newly created directory

`cd /syaaraat`

Create a new .env file from .env.example

`cp .env.example .env`

Now edit your .env file and set your env parameters (Specially the database username/pass, database name)

Install dependencies

`composer install`

Generate a new key for your app

`php artisan key:generate`

Reload Database

`php artisan migrate:refresh --seed`

Done, You're ready to go

`php artisan serve`

## Link Register.

`http://127.0.0.1:8000/admin/register`

## If there is a problem with migrate, I will upload the data base

## If you want to look at the code in the file

`cd app\Modules`
