<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::post('api/login', function (Request $request) {
//     return 'Hello';
// });

Route::get('/dashboard', function () {
    $user = \Auth::user();
    //dd($user->tokens->count());
    return view('dashboard')->with(['user' => $user]);
})->middleware(['auth'])->name('dashboard');

Route::post('/tokens/create', function (Request $request) {
    $user = \Auth::user();
    $token = $request->user()->createToken($request->token_name);
    // dd($token->plainTextToken);
    // return ['token' => $token->plainTextToken];
    return view('dashboard')->with(['user' => $user, 'token' => $token->plainTextToken]);
});

require __DIR__.'/auth.php';
