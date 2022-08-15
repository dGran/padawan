<?php

use App\Http\Controllers\MerchandisingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'merchandising'], function () {
    Route::get('/', [MerchandisingController::class, 'index'])->name('merchandising');
});
