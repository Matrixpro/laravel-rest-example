<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VehicleController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| NOTE: The following routes auto prefix using 'api/'
*/

Route::apiResource('vehicles', VehicleController::class)
    ->except(['update']) // use put/patch instead
    ->middleware('auth:sanctum');

Route::put('/vehicles/{vehicle}', [VehicleController::class, 'put'])->name('put');
Route::patch('/vehicles/{vehicle}', [VehicleController::class, 'patch'])->name('patch');

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
