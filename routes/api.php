<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Register Email Check
Route::get('register/check', 'Auth\RegisterController@check')->name('api-register-check');

// Location Controller API
Route::get('provinces', 'API\LocationController@provinces')->name('api-provinces');
Route::get('regencies/{provinces_id}', 'API\LocationController@regencies')->name('api-regencies');
Route::get('districts/{regencies_id}', 'API\LocationController@districts')->name('api-disctricts');

// Hidden users_id API
Route::get('user/id', 'API\UserController@hidden')->name('api-user-hidden');