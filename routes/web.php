<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')  // cartella dei Controller
    ->name('admin.')      // pima parte del nome della route
    ->prefix('admin')     // prefisso comune degli URL
    ->group(function() {  // il tutto si applica a un gruppo di rotte
        
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/profile/edit','UserController@edit')->name('users.edit');
        Route::put('/profile/update','UserController@update')->name('users.update');
        Route::delete('/profile/destroy','UserController@destroy')->name('users.destroy');
        Route::get('messages', 'MessageController@index')->name('messages.index');
        Route::get('reviews', 'reviewController@index')->name('reviews.index');
        Route::get('/sponsor','UserController@sponsor')->name('users.sponsor');
        Route::post('/pay','UserController@pay')->name('users.pay');
        
    });

Route::get('{any?}', function() {
    $user = Auth::user();
    $user = collect($user)->toArray();
    return view('guest.home',$user);
})->where('any', '.*')->name('guest.home');