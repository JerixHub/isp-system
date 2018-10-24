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

// Sales Routes
Route::get('sales', 'SalesController@index');

// Inventory Routes
Route::prefix('inventory')->middleware('auth')->group(function(){
	Route::get('/', 'InventoryController@index');

	// Products
	Route::resource('products', 'ProductsController');

	// Categories
	Route::resource('categories', 'CategoryController');
	Route::delete('categories/ajax/{id}', 'CategoryController@ajax_destroy');

	// Unit Measure
	Route::resource('unit-measures', 'UnitMeasureController');
	Route::delete('unit-measures/ajax/{id}', 'UnitMeasureController@ajax_destroy');

	// Supplier
	Route::resource('suppliers', 'SupplierController');
	Route::delete('suppliers/ajax/{id}', 'SupplierController@ajax_destroy');
});


// Dashboard Route
Route::get('dashboard', 'DashboardController@index');

// Authentication Routes
// Auth::routes();
// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Home Route
Route::get('/home', 'HomeController@index')->name('home');
