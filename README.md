# MyShop
我的第一个商城
Installation
This is just local installation using something like MAMP/WAMP or xampp. Of course you are free to use homestead if you like.

clone the repo and cd into it
composer install
make sure db is running and credentials are setup in config\database.php (or in your .env file).
If you have no .env file you can use the example one. Just rename .env.example to .env. Enter your db credentials here.
php artisan key:generate
php artisan migrate
(Optional) Run vendor/bin/phpunit to run some application tests I have written. Have a look at them in the tests folder.
php artisan serve
Visit localhost:8000 in your browser
