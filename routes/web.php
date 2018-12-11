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

Route::get('/', 'LandingCotroller@index');
Route::get('/features', 'LandingCotroller@feature');
Route::get('/privacy-policy', 'LandingCotroller@privacy_policy');
Route::get('/terms-and-services', 'LandingCotroller@terms_services');
Route::get('/demo', 'LandingCotroller@demo');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stores', 'StoresController@index');
Route::post('/stores', 'StoresController@store');
Route::get('/stores/{store}', 'StoresController@show');
Route::post('/stores/{store}/delete', 'StoresController@destroy');
Route::post('/stores/{store}/update', 'StoresController@update');

Route::post('/stores/{store}/manager', 'ManagersController@store');
Route::post('/stores/{store}/manager/{manager}/update', 'ManagersController@update');
Route::post('/stores/{store}/manager/{manager}/delete', 'ManagersController@destroy');
