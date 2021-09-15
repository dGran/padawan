<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Account\MyAccount;
use App\Http\Livewire\Account\EditProfile;
use App\Http\Livewire\Account\Notification;
use App\Http\Livewire\Account\MyTeam;
use App\Http\Livewire\Tournament\Dashboard;
use App\Http\Livewire\Tournament\Standing;
use App\Http\Livewire\Tournament\Schedule;
use App\Http\Livewire\Tournament\Stat;
use App\Http\Livewire\Tournament\Participant;
use App\Http\Livewire\Tournament\Normative;
use App\Http\Livewire\Tournament\Race;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/politica-de-cookies', function () {
    return view('cookie-policy');
})->name('cookie-policy');

Route::get('/politica-de-privacidad', function () {
    return view('privacity-policy');
})->name('privacity-policy');

// account routes
Route::group(['prefix' => 'mi-cuenta', 'middleware' => ['auth', 'password.confirm', 'checkProfile']], function () {
    Route::get('/', MyAccount::class)->name('account');
    Route::get('/editar-perfil', EditProfile::class)->name('edit-profile');
    Route::get('/notifications', Notification::class)->name('notifications');
});
Route::group(['prefix' => 'notificaciones', 'middleware' => ['auth', 'password.confirm', 'checkProfile']], function () {
    Route::get('/', Notification::class)->name('notifications');
});
Route::group(['prefix' => 'mis-equipos', 'middleware' => ['auth', 'password.confirm', 'checkProfile']], function () {
    Route::get('/', MyTeam::class)->name('myteams');
});

// tournament routes
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

// test
Route::get('/gt-sport', function () {
    return view('gt-sport');
})->name('gt-sport');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';