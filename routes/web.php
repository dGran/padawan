<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Account\MyTeam;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/politica-de-cookies', function () {
    return view('cookie-policy');
})->name('cookie-policy');

Route::get('/politica-de-privacidad', function () {
    return view('privacity-policy');
})->name('privacity-policy');

// test
Route::get('/gt-sport', function () {
    return view('gt-sport');
})->name('gt-sport');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/account.php';
require __DIR__.'/tournaments.php';
require __DIR__.'/eteams.php';
require __DIR__.'/market.php';
require __DIR__.'/merchandising.php';
