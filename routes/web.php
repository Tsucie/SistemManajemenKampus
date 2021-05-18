<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffCategoryController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;

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

//Route Single Action invokable Controller
Route::get('/UserType/All', UserTypeController::class);

/**
 * API Resource Routes
 * 
 * Route yang digunakan API yang akan mengexclude otomatis method create dan edit
 */
Route::apiResources([
	'StaffCategory' => StaffCategoryController::class,
	'Client' => ClientController::class
]);

/**
 * Route Resources Controller
 * 
 * Berisi Controller-controller yang menggunakan ressource model Eloquent untuk CRUD data
 * @param Array ['URI' => controller::class]
*/
Route::resources([
	'Site' => SiteController::class
]);

// Route yang harus menggunakan AUTH
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/client', 'App\Http\Controllers\ClientController@index')->name('client');
Route::get('/site', 'App\Http\Controllers\SiteController@index')->name('site');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

