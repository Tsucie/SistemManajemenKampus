<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StaffCategoryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
//Route Per-Method Controller
Route::get('/Fakultas/GetAll', 'App\Http\Controllers\FakultasController@getAll');
Route::get('/Prodi/GetList/{id}', 'App\Http\Controllers\ProgramStudiController@getList');
Route::get('/Matkul/GetList/{id}', 'App\Http\Controllers\MataKuliahController@getList');

Route::group(['middleware' => 'auth'], function () {
	Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
	// (PAGES) Route yang harus menggunakan Authentikasi & Authorisasi
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::get('/client', [ClientController::class, 'index'])->name('client');
	Route::get('/site', [SiteController::class, 'index'])->name('site');
	Route::get('/staff', [StaffController::class, 'index'])->name('staff');

	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);

	//Route Single Action invokable Controller
	Route::get('/UserType/All', UserTypeController::class);

	/**
	 * API Resource Routes
	 * Route yang digunakan untuk API yang akan mengexclude otomatis method create dan edit
	 */
	Route::apiResources([
		'StaffCategory' => StaffCategoryController::class,
		'Client' => ClientController::class,
		'Fakultas' => FakultasController::class,
		'Prodi' => ProgramStudiController::class,
		'Matkul' => MataKuliahController::class
	]);

	/**
	 * Route Resources Controller
	 * Berisi Controller-controller yang menggunakan ressource model Eloquent untuk CRUD data
	 * Dan menampilkan view
	 * @param Array ['URI' => controller::class]
	*/
	Route::resources([
		'Site' => SiteController::class,
		'Staff' => StaffController::class
	]);
});