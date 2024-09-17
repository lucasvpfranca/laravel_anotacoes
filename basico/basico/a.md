# Criar projeto

composer create-project laravel/laravel basico


# Comandos Artisan
php artisan make:controller MainController

php artisan make:view layouts/main_layout


php artisan make:migration create_users_table
php artisan make:migration create_notes_table

php artisan migrate

php artisan migrate:rollback // volta 1 


php artisan make:seeder UsersTableSeeder


php artisan db:seed UsersTableSeeder

php artisan make:model User



php artisan make:middleware CheckIsLogged
php artisan make:middleware CheckIsNotLogged

php artisan make:view top_bar
