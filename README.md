<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
Fully working export download and import upload of CSV files using Collection
#Install in the terminal composer command for Laravel project
Then in the terminal install Laravel Excel
#composer require maatwebsite/excel
Add the model with -a to install all(Controller-Model-Migration-Seeder-Factory)
php artisan make:model stock -a
after you add the columns to the table then run migrate with below command
php artisan migrate
for export add the following
#php artisan make:export StocksExport --model=Stock
for import add the following
#php artisan make:import StocksImport --model=Stock