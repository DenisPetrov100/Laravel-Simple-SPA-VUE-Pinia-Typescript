# About the App

This is Laravel VueJS SPA App for users and admin, to creating payments. If you are admin, then you can see payments of others

## Features:
- Registration
- Login
- Users management for admin
- Payments report
- All payments report (admin only)

## Backend:
- Laravel 9
- Laravel Spatie for roles/permissons polycies
- Laravel Breeze for auth
- Laravel Octane for speeding up PHP
- Laravel Sail to start it in Docker

## Frontend:
- Vue 3 with Vue Router for SPA
- Typescript for typing objects
- Pinia for state management
- Tailwind for UI

## Testing 
- Standart Unit/Feature testing for backend
- Cypress for end-to-end testing

# Requirements
- PHP 8.0
- MySQL 10
- to use Laravel Sail on Windows you need WSL v2 and Docker Desktop with shared to WSL resources

# Installation

- set ENV vars (url, port, DB creds)
- npm install
- composer install
- php artisan migrate:fresh --seed
- npm run dev

## Creds to login as user:

- login: user@user.com
- password: 12345678

## Creds to login as admin:

- login: admin@admin.com
- password: 12345678


## Serving on Windows using Laravel Sail and Laravel Octane in Docker:

- Install Docker Desktop
- Install WSL Ubuntu-20.04 from Windows store 
- Convert to v2 `wsl.exe --set-version Ubuntu-20.04 2`
- Share Resources in Docker Settings
    
## Useing Swoole

    https://blog.devgenius.io/laravel-sail-with-https-swoole-ddab7f5303ec
