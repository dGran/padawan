<?php

use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

Route::get('/', 'HomeController@home')->name('home');
// password confirm middleware example
// Route::get('/', 'HomeController@home')->name('home')->middleware('password.confirm');
Route::get('/usuarios/perfil', 'HomeController@profile')->name('profile')->middleware('auth', 'verified');
Route::put('/usuarios/perfil', 'HomeController@profileUpdate')->name('profile.update')->middleware('auth', 'verified');

Route::get('/contacto', 'ContactController@index')->name('contact');
Route::post('/contacto', 'ContactController@send')->name('contact.send')->middleware(ProtectAgainstSpam::class);

Route::get('/politica_de_privacidad', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('/politica_de_cookies', 'HomeController@cookie_policy')->name('cookie_policy');

Route::prefix('/posts')->group(function () {
	Route::get('/', 'PostController@index')->name('posts');
	Route::get('{post:id}/destroy', 'PostController@destroy')->name('posts.destroy')->middleware('permission:destroy_posts');
});

Route::prefix('/torneos')->group(function () {
	Route::get('/', 'TournamentController@index')->name('tournaments');
	Route::get('/{tournament:slug}', 'TournamentController@view')->name('tournaments.view');
});

Route::prefix('/admin')->middleware(['auth', 'isAdmin', 'password.confirm'])->group(function () {
	Route::get('/', 'Admin\AdminController@dashboard')->name('admin');
	Route::get('/usuarios', 'Admin\UserController@list')->name('admin.users');
	Route::get('/usuarios/nuevo', 'Admin\UserController@add')->name('admin.users.add');
	Route::post('/usuarios/nuevo', 'Admin\UserController@save')->name('admin.users.save');
	Route::get('/usuarios/editar/{id}', 'Admin\UserController@edit')->name('admin.users.edit');
	Route::put('/usuarios/editar/{id}', 'Admin\UserController@update')->name('admin.users.update');
	Route::get('/usuarios/ver/{id}', 'Admin\UserController@view')->name('admin.users.view');
	Route::get('/usuarios/eliminar/{ids}', 'Admin\UserController@destroy')->name('admin.users.destroy');
	Route::get('/usuarios/duplicar/{ids}', 'Admin\UserController@duplicate')->name('admin.users.duplicate');
	Route::get('/usuarios/exportar/{format}/{ids}/{filename}/{sortField}/{sortDirection}', 'Admin\UserController@export')->name('admin.users.export');
	Route::get('/usuarios/exportar-tabla-completa/{format}/{filename}/{sortField}/{sortDirection}/{filterName?}', 'Admin\UserController@exportGlobal')->name('admin.users.export.global');
	Route::post('/usuarios/importar', 'Admin\UserController@import')->name('admin.users.import');
});

Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');