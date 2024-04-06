## Учебный проект
Для запуска проекта выполните следующие команды:
```sh
git clone https://github.com/VARD0V/learn-laravel-10.loc.git
```
```sh
cd learn-laravel-10.loc
```
```sh
composer install
```
```sh
php artisan key:generate
```
Переименуйте файл *.env.example* -> *.env* и пропишите настройки подключения к БД
```sh
php artisan migrate --seed
```


