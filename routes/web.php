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
Route::prefix('inventory')->middleware('auth')->group(function(){
	Route::get('/', 'InventoryController@index');

	// Products
	Route::resource('products', 'ProductsController');

	// Categories
	Route::resource('categories', 'CategoryController');
	Route::delete('categories/ajax/{id}', 'CategoryController@ajax_destroy');

	// Brands
	Route::resource('brands', 'BrandsController');

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
Auth::routes();

// Home Route
Route::get('/home', 'HomeController@index')->name('home');
