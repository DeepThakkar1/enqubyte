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

Route::get('/users/email/{email}/available', 'UsersController@emailIsAvailable');
Route::get('/users/username/{username}/available', 'UsersController@usernameIsAvailable');
Route::post('/users/mode', 'UsersController@mode');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stores', 'StoresController@index');
Route::post('/stores', 'StoresController@store');
Route::get('/stores/{store}', 'StoresController@show');
Route::post('/stores/{store}/delete', 'StoresController@destroy');
Route::post('/stores/{store}/update', 'StoresController@update');

Route::post('/stores/{store}/manager', 'ManagersController@store');
Route::post('/stores/{store}/manager/{manager}/update', 'ManagersController@update');
Route::post('/stores/{store}/manager/{manager}/delete', 'ManagersController@destroy');


/*Route::get('/managers', 'ManagersController@index');
Route::post('/managers', 'ManagersController@store');
*/
Route::get('/products', 'ProductsController@index');
Route::post('/products', 'ProductsController@store');
Route::get('/products/{product}', 'ProductsController@show');
Route::get('/products/{product}/get', 'ProductsController@get');
Route::post('/products/{product}/delete', 'ProductsController@destroy');
Route::post('/products/{product}/update', 'ProductsController@update');

Route::post('/stores/{store}/products/{product}/assign', 'StocksController@store');

Route::get('/employees', 'EmployeesController@index');
Route::post('/employees', 'EmployeesController@store');
Route::get('/employees/{employee}', 'EmployeesController@show');
Route::post('/employees/{employee}/delete', 'EmployeesController@destroy');
Route::post('/employees/{employee}/update', 'EmployeesController@update');

Route::get('/visitors', 'VisitorsController@index');
Route::post('/visitors', 'VisitorsController@store');
Route::get('/visitors/{visitor}', 'VisitorsController@show');
Route::post('/visitors/{visitor}/delete', 'VisitorsController@destroy');
Route::post('/visitors/{visitor}/update', 'VisitorsController@update');


Route::get('/customers', 'CustomersController@index');
Route::post('/customers', 'CustomersController@store');
Route::get('/customers/{customer}', 'CustomersController@show');
Route::post('/customers/{customer}/delete', 'CustomersController@destroy');
Route::post('/customers/{customer}/update', 'CustomersController@update');

Route::get('/enquiries', 'EnquiriesController@index');
Route::get('/enquiries/add', 'EnquiriesController@create');
Route::get('/enquiries/{enquiry}/edit', 'EnquiriesController@edit');
Route::post('/enquiries', 'EnquiriesController@store');
Route::get('/enquiries/{enquiry}', 'EnquiriesController@show');
Route::post('/enquiries/{enquiry}/delete', 'EnquiriesController@destroy');
Route::post('/enquiries/{enquiry}/update', 'EnquiriesController@update');

Route::get('/sales/invoices', 'InvoicesController@index');
Route::get('/sales/invoices/add', 'InvoicesController@create');
Route::get('/sales/invoices/{invoice}/edit', 'InvoicesController@edit');
Route::post('/sales/invoices', 'InvoicesController@store');
Route::get('/sales/invoices/{invoice}', 'InvoicesController@show');
Route::post('/sales/invoices/{invoice}/delete', 'InvoicesController@destroy');
Route::post('/sales/invoices/{invoice}/update', 'InvoicesController@update');

Route::get('/settings', 'SettingsController@index');
Route::post('/settings/general/mode', 'SettingsController@changeMode');
Route::post('/settings/profile/update', 'SettingsController@updateProfile');
Route::post('/settings/security/changepassword', 'SettingsController@updatePassword');
