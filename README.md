
#Fully working export download and import upload of CSV files using Collection
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