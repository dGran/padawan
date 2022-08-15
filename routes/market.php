<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'mercado'], function () {
    Route::get('/', [MarketController::class, 'index'])->name('market');
});
