<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'password.confirm'])->name('admin.dashboard');
