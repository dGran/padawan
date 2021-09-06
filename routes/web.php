<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Account\MyAccount;
use App\Http\Livewire\Account\EditProfile;

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
Route::get('/mi-cuenta', MyAccount::class)->middleware(['auth', 'password.confirm'])->name('account');
Route::get('/mi-cuenta/editar-perfil', EditProfile::class)->middleware(['auth', 'password.confirm'])->name('edit-profile');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';