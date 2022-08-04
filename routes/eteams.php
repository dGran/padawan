<?php

use App\Http\Livewire\Eteam\Eteam;
use App\Http\Livewire\ETeams\EteamCreate;
use App\Http\Livewire\ETeams\EteamList;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'equipos-esports'], function () {
    Route::get('/', EteamList::class)->name('eteams');
    Route::get('/nuevo-equipo', EteamCreate::class)->name('eteams.create')->middleware('auth');
    Route::get('/{slug}', Eteam::class)->name('eteam');
});
