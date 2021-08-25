<?php

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
    return view('dashboard');
})->name('dashboard');

Route::get('/politica-de-cookies', function () {
    return view('cookie-policy');
})->name('cookie-policy');

Route::get('/politica-de-privacidad', function () {
    return view('privacity-policy');
})->name('privacity-policy');

// user routes
Route::get('/cuenta/perfil', function () {
    return view('account.profile');
})->middleware(['auth'])->name('profile');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
