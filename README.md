<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Introduction

This API for sending email to specified email, There is used Laravel 8.* with Jetstream, Livewire

## Installation

1. git clone https://github.com/aram-shakyan/email-api.git 
2. composer install
3. copy .env.example content into .env file
4. configure Database configuration
5. configure email for eg: mailtrap (please fill all email related keys)
6. configure `RECEIVER_EMAIL` -> this key for sending each email to specified email
7. configure `QUEUE_CONNECTION` for eg: `database` then queue will work with database (NOTE: the emails sending functionality working with queue)
8. run `php artisan key:generate` 
9. run `php artisan migrate`
10. run `yarn install` or `npm install`
11. run `yarn dev` or `npm run dev`
12. configure vhost or run `php artisan serve`

## How to use

1. Open the webiste url
2. Click on top right `Register` link
3. Fill Registration data and submit 
4. Login with specified email / password
5. click top right `{name}` opens dropdown 
6. click `API TOKENS` link
7. set any Token name submit 
8. copy modal token (this token for authentication API)
9. open POSTMAN (you can import postman collection and check API endpoint)
10. send email to Api Endpoint with copied token
11. if `QUEUE_CONNECTION` not equal to `sync`  you need to run `php artisan queue:work` with `--tries=1` as you want
12. after successfully email sent you can check email (which you specified on .env) and also can see the email on `dashboard`

## Unit Test

- For unit Test you can run `php artisan test`
