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

// Sales Routes
Route::get('sales', 'SalesController@index');

// Inventory Routes
// Route::get('inventory', 'InventoryController@index');
Route::prefix('inventory')->middleware('auth')->group(function(){
	Route::get('/', 'InventoryController@index');

	// Products
	Route::resource('products', 'ProductsController');

	// Categories
	Route::resource('categories', 'CategoryController');
	Route::delete('categories/ajax/{id}', 'CategoryController@ajax_destroy');
	Route::get('categories/livesearch/{text}', 'CategoryController@ajax_search');

	// Brands
	Route::resource('brands', 'BrandsController');
});


// Dashboard Route
Route::get('dashboard', 'DashboardController@index');

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', 'HomeController@index')->name('home');
