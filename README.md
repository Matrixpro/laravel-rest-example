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
<p>At this point, when running 'composer test', all tests should pass. Test user and test vehicles are seeded.</p>

Test user creds:
```
Name: admin
Email: admin@test.com
Password: password
```

NOTES
-----
- Visit installation URL /docs for API documentation (for example: localhost/docs)
- API auth via laravel's Sanctum: https://laravel.com/docs/9.x/sanctum 
- Soft deletes via laravel's eloquent: https://laravel.com/docs/9.x/eloquent#soft-deleting 
- Refer to file system /tests/Feature for example usage
- Edit .env 'VEHICLE_CONDITION' to restrict type: any/new/used
- Use /api/register to create new user (will also provide bearer token)
- Or use /api/login for existing user to get bearer token
- CRUD Endpoints:
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
order_direction (enum: ASC, DESC)
search_in (same values as order_by)
search_for (str)
```

