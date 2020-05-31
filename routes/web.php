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
Route::post('/usuarios/perfil', 'HomeController@profileUpdate')->name('profile.update')->middleware('auth', 'verified');

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
	Route::get('/', 'AdminController@dashboard')->name('admin');
	Route::get('/torneos', 'AdminController@tournaments')->name('admin.tournaments');
});

Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');