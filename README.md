Laravel 9 REST API Example
================================

<p>A small REST API example in Laravel 9.</p>

<p>After downloading the repo:</p>

A) Set DB info in .env.example and rename to .env<br>
B) Run commands:<br>

```
composer install
npm install
npm run dev
php artisan migrate
php artisan db:seed
composer test
```
At this point, when running 'composer test', all tests should pass.

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
- Edit .env 'VEHICLE_CONDITION' to restrict type: any/new/used
- 
- Use /api/register to create new user (will also provide bearer token)<br>
- Or use /api/login for existing user to get bearer token<br>
- CRUD Endpoints (Swagger docs coming soon):<br>
```
GET - Get one vehicle: /api/vehicles/{id}
GET - Get all vehicles: /api/vehicles
POST - Create a vehicle: /api/vehicles
PUT - Put a vehicle: /api/vehicles/{id}
PATCH - Patch a vehicle: /api/vehicles/{id}
DELETE - Delete one vehicle: /api/vehicles/{id}
```
Optional params for GET All:
```
per_page (int)
order_by (enum: type, msrp, make, year, model, miles, vin, created_at, updated_at, id)
order_direction (enum: ASC, DESC)
search_in (same values as order_by)
search_for (str)
```

