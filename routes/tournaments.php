<?php

use App\Http\Livewire\Tournament\Dashboard;
use App\Http\Livewire\Tournament\Normative;
use App\Http\Livewire\Tournament\Participant;
use App\Http\Livewire\Tournament\Race;
use App\Http\Livewire\Tournament\Schedule;
use App\Http\Livewire\Tournament\Standing;
use App\Http\Livewire\Tournament\Stat;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'nombre-del-torneo'], function () {
    Route::get('/', Dashboard::class)->name('tournament.dashboard');
    Route::get('/clasificaciones', Standing::class)->name('tournament.standings');
    Route::get('/calendario', Schedule::class)->name('tournament.schedule');
    Route::get('/calendario/nombre-de-la-carrera', Race::class)->name('tournament.race');
    Route::get('/estadisticas', Stat::class)->name('tournament.stats');
    Route::get('/participantes', Participant::class)->name('tournament.participants');
    Route::get('/normativa', Normative::class)->name('tournament.normative');
    // Route::group(['prefix' => 'calendario/nombre-de-la-carrera'], function () {
    //     Route::get('/circuito', Race::class)->name('tournament.race.circuit');
    //     Route::get('/calificacion', Race::class)->name('tournament.race.qualy');
    //     Route::get('/carrera', Race::class)->name('tournament.race.race');
    //     Route::get('/multimedia', Race::class)->name('tournament.race.multimedia');
    // });
});
