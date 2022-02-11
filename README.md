Laravel 9 REST API Example
================================

<p>A small REST API example in Laravel 9.</p>

<p>After downloading the repo:</p>

A) Set DB info in .env.example and rename to .env<br>
B) Run commands:<br>

```
composer install
npm install
npm run-dev
php artisan migrate
php artisan db:seed

```

NOTES
-----
- Test admin user is seeded with the following:<br>
```
Name: admin
Email: admin@test.com
Password: password
```
- Test vehicles are seeded<br>
- API auth via laravel's Sanctum: https://laravel.com/docs/9.x/sanctum <br>
- Soft deletes via laravel's eloquent: https://laravel.com/docs/9.x/eloquent#soft-deleting <br>
- Refer to /tests/Feature for example usage<br>

