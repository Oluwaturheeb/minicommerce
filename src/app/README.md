<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


# How to run this Project
<p>

`git clone https://github.com/oluwaturheeb/minicommerce.git`
</p>
<p>
This project is a containerized application, therefore make sure you have docker installed before running this project.

`cd minicommerce`

Run the init script at the root of this project

`./init`

For some reason if laravel migration doesn't run due time it take for mysql to start, kindly run laravel migration
Enter the docker laravel service

`docker exec -it laravel bash`

then migration

`php artisan migrate:fresh --seed`

Also for some reason the kafka might not be installed from the initialization install it from here

`./kafka.sh`

</p>
