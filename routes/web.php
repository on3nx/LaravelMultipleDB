<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'staticController@welcome');
Route::get('about', 'staticController@about');
Route::get('contact', 'staticController@contact');

Auth::routes();

Route::get('home', 'HomeController@index');

Route::get('user/activate/', 'ActivationController@index');
Route::get('user/activate/{token}', 'ActivationController@activateUser')->name('user.activate');

Route::get('profile', 'Auth\ProfileController@index');
Route::patch('profile/update', 'Auth\ProfileController@update');

Route::get('company', 'Auth\CompanyController@index');
Route::get('company/register', 'Auth\CompanyController@update');
Route::get('company/{id}', 'Auth\CompanyController@update');
Route::patch('company/{id}/update', 'Auth\CompanyController@update');