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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('radars', function () {
//     $radars = App\Radar::all();
//     return view('radars.index', compact('radars'));
// });

// Route::get('radars/{radar}', function (App\Radar $radar) {    
//     //$radar = App\Radar::find($id);   
//     return view('radars.show', compact('radar'));
// });

// Route::get('drivers', function () {
    // $drivers = App\Driver::all();
    // return view('drivers.index', compact('drivers'));
// });

// Route::get('drivers/{driver}', function (App\Driver $driver) {    
//     //$driver = App\Driver::find($id);   
//     return view('drivers.show', compact('driver'));
// });

Route::get('/', 'RadarsController@index')->name('home');

Route::get('radars', 'RadarsController@index');
Route::get('radars/create', 'RadarsController@create');
Route::post('radars', 'RadarsController@store');
Route::get('radars/{radar}', 'RadarsController@show');
Route::get('radars/{radar}/edit', 'RadarsController@edit');
Route::put('radars/{radar}', 'RadarsController@update');
Route::delete('radars/{radar}', 'RadarsController@destroy');


Route::get('drivers', 'DriversController@index');
Route::get('drivers/create', 'DriversController@create');
Route::post('drivers', 'DriversController@store');
Route::get('drivers/{driver}', 'DriversController@show');
Route::get('drivers/{driver}/edit', 'DriversController@edit');
Route::put('drivers/{driver}', 'DriversController@update');
Route::delete('drivers/{driver}', 'DriversController@destroy');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('language/{language}', 'LanguagesController@language');
