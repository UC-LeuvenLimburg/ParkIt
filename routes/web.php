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

Route::get('/', 'HomeController@index')->name('home');
Route::middleware('auth')->get('/profile', 'UserController@profile');
Route::middleware('auth')->get('/myleases', 'LeaseController@index');
Route::middleware('auth')->get('/myplaces', 'RentableController@index');
Route::middleware('auth')->resource('users', 'UserController');
Route::middleware('auth')->resource('leases', 'LeaseController');
Route::middleware('auth')->resource('rentables', 'RentableController');
Route::middleware('auth')->get('/lease', 'RentableController@create');
Route::middleware('auth')->get('/rent', 'RentableController@index');
