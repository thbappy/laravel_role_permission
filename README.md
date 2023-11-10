# laravel_role_permission
Laravel Role Permission Management System - Laravel 9.x
Spatie role permission package

Git clone -

git clone https://github.com/thbappy/laravel_role_permission.git

Go to project folder -

cd laravel_role_permission

Install Laravel Dependencies -

composer install

Create database called - laravel_role_permission

Create .env file by copying .env.example file

Generate Artisan Key (If needed) -

php artisan key:generate

Migrate Database with seeder -

php artisan migrate --seed

Run Project -

php artisan serve

How it works

Login using Super Admin Credential -

Username - admin@gmail.com

Password - password

Create Role, Permission & assign Role with User

Check by login with the new credentials.

If you've not enough permission to do any task, you'll get a warning message.

Login Cradiantial

=============== admin =====

gmail: admin@gmail.com

password: password

access type: all access

============================

=============== Manager =====

gmail: manager@gmail.com

password: password

access type: Only User Create & view role & permission list

============================

=============== Employee =====

gmail: employee@gmail.com

password: password

access type: Only view user, role & permission list

============================





