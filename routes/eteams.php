<?php

use App\Http\Livewire\ETeams\ETeam;
use App\Http\Livewire\ETeams\ETeamCreate;
use App\Http\Livewire\ETeams\ETeamList;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'equipos-esports'], function () {
    Route::get('/', ETeamList::class)->name('eteams.index');
    Route::get('/nuevo-equipo', ETeamCreate::class)->name('eteams.create')->middleware('auth');
    Route::get('/{slug}', ETeam::class)->name('eteams.eteam');
});
