<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// API Routes using the web auth middelware
Route::middleware('auth')->resource('web/api/users', 'API\APIUserController');
Route::middleware('auth')->get('web/api/all/users', 'API\APIUserController@indexall');
Route::middleware('auth')->resource('web/api/rentables', 'API\APIRentableController');
Route::middleware('auth')->get('web/api/all/rentables', 'API\APIRentableController@indexall');
Route::middleware('auth')->resource('web/api/leases', 'API\APILeaseController');
Route::middleware('auth')->get('web/api/all/leases', 'API\APILeaseController@indexall');

// Web Routes
Route::get('/', 'HomeController@index')->name('home');
Route::middleware('auth')->get('/profile', 'UserController@profile');
Route::middleware('auth')->get('/createlease/{id}', 'LeaseController@createlease');
Route::middleware('auth')->get('/myleases', 'LeaseController@myleases');
Route::middleware('auth')->get('/myplaces', 'RentableController@myplaces');
Route::middleware('auth')->resource('users', 'UserController');
Route::middleware('auth')->resource('leases', 'LeaseController');
Route::middleware('auth')->resource('rentables', 'RentableController');
Route::middleware('auth')->get('/lease', 'RentableController@create');
Route::middleware('auth')->get('/rent', 'RentableController@index');
