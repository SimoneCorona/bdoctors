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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/users', 'Api\UserController@index')->name('api.users.index');
Route::get('/users/{slug}', 'Api\UserController@show')->name('api.users.show');
Route::get('/specialties', 'Api\SpecialtyController@index')->name('api.specialties.index');
Route::get('/search/{slug}', 'Api\UserController@search')->name('api.users.search');

Route::post("/review", 'Api\ReviewController@store')->name('api.reviews.store');