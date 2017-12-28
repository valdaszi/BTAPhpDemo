<?php

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

Route::get('radars', 'RadarsController@index');

Route::get('radars/create', 'RadarsController@create');
Route::post('radars', 'RadarsController@store');

Route::get('radars/{radar}', 'RadarsController@show');
Route::get('radars/{radar}/edit', 'RadarsController@edit');
Route::put('radars/{radar}', 'RadarsController@update');

Route::get('radars/{radar}/delete', 'RadarsController@delete');

Route::delete('radars/{radar}', 'RadarsController@destroy');

Route::get('drivers', 'DriversController@index');
Route::get('drivers/create', 'DriversController@create');
Route::post('drivers', 'DriversController@store');
Route::get('drivers/{driver}', 'DriversController@show');
Route::get('drivers/{driver}/edit', 'DriversController@edit');
Route::put('drivers/{driver}', 'DriversController@update');
Route::delete('drivers/{driver}', 'DriversController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/language/{language}', 'LanguageController@language')->name('language');
