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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')  // cartella dei Controller
    ->name('admin.')      // pima parte del nome della route
    ->prefix('admin')     // prefisso comune degli URL
    ->group(function() {  // il tutto si applica a un gruppo di rotte
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/profile','UserController@show')->name('profile');
        Route::get('/profile/edit','UserController@edit')->name('profile');
        // Route::resource('users', 'UserController');
    });



Route::get('/home', 'HomeController@index')->name('home');
