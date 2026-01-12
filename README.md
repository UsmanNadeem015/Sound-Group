
<!-- To Run this project after downloading/cloning it from gitub run these -->
npm install
composer install
composer require laravel/sanctum
php artisan storage:link



<!--  Only do this part if after running composer install it throws an error -->
<!--  close VS code -->
<!--  open powershell as admin -->
<!--  goto project directory using  -->
cd "D:\Projects\Aptech semester end projects\S2\Sound-Group-main"

<!-- delete half installed dependencies -->
rmdir /s /q vendor
re run composer install
<!-- Only do this part if after running composer install it throws an error -->

copy .env.example .env
php artisan key:generate

<!-- In .env  change-->
DB_CONNECTION=sqlite
<!-- to -->
DB_CONNECTION=mysql

<!-- Run Project -->
npm run dev
php artisan serve



