<?php

use App\Http\Controllers\MyTeamsController;
use App\Http\Livewire\Account\EditProfile;
use App\Http\Livewire\Account\MyAccount;
use App\Http\Livewire\Account\Notification;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'mi-cuenta', 'middleware' => ['auth', 'checkProfile']], function () {
    Route::get('/', MyAccount::class)->name('account');
    Route::get('/editar-perfil', EditProfile::class)->name('edit-profile');
});
Route::group(['prefix' => 'notificaciones', 'middleware' => ['auth', 'checkProfile']], function () {
    Route::get('/', Notification::class)->name('notifications');
});
Route::group(['prefix' => 'mis-equipos', 'middleware' => ['auth', 'checkProfile']], function () {
    Route::get('/', [MyTeamsController::class, 'index'])->name('myteams');
    Route::get('/aceptar-invitacion/{eteamInvitation}', [MyTeamsController::class, 'acceptInvitation'])->name('myteams.acceptInvitation');
    Route::get('/rechazar-invitacion/{eteamInvitation}', [MyTeamsController::class, 'declineInvitation'])->name('myteams.declineInvitation');
    Route::get('/aceptar-solicitud/{eteamRequest}', [MyTeamsController::class, 'acceptRequest'])->name('myteams.acceptRequest');
    Route::get('/rechazar-solicitud/{eteamRequest}', [MyTeamsController::class, 'declineRequest'])->name('myteams.declineRequest');
    Route::get('/abandonar-equipo/{eteamUser}', [MyTeamsController::class, 'leaveEteam'])->name('myteams.leaveEteam');
    Route::get('/disolver-equipo/{eteam}', [MyTeamsController::class, 'disolveEteam'])->name('myteams.disolveEteam');
});
