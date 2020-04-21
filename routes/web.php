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
Route::middleware('auth')->get('/users/profile','UserController@profile');
Route::middleware('auth')->get('/leases/myleases','LeaseController@myleases');
Route::middleware('auth')->get('/rentables/myplaces','RentableController@myplaces');
Route::middleware('auth')->resource('users', 'UserController');
Route::middleware('auth')->resource('leases', 'LeaseController');
Route::middleware('auth')->resource('rentables', 'RentableController');
