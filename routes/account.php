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
    Route::get('/aceptar-invitacion/{userId}/{eteamInvitationId}', [MyTeamsController::class, 'acceptInvitation'])->name('myteams.acceptInvitation');
    Route::get('/rechazar-invitacion/{userId}/{eteamInvitationId}', [MyTeamsController::class, 'declineInvitation'])->name('myteams.declineInvitation');
    Route::get('/eliminar-invitacion/{eteamInvitationId}', [MyTeamsController::class, 'destroyInvitation'])->name('myteams.destroyInvitation');
    Route::get('/retirar-invitacion/{userId}/{eteamInvitationId}', [MyTeamsController::class, 'retireInvitation'])->name('myteams.retireInvitation');

    Route::get('/aceptar-solicitud/{userId}/{eteamRequestId}', [MyTeamsController::class, 'acceptRequest'])->name('myteams.acceptRequest');
    Route::get('/rechazar-solicitud/{userId}/{eteamRequestId}', [MyTeamsController::class, 'declineRequest'])->name('myteams.declineRequest');
    Route::get('/eliminar-solicitud/{eteamRequestId}', [MyTeamsController::class, 'destroyRequest'])->name('myteams.destroyRequest');
    Route::get('/retirar-solicitud/{userId}/{eteamRequestId}', [MyTeamsController::class, 'retireRequest'])->name('myteams.retireRequest');

    Route::get('/abandonar-equipo/{EteamUser}', [MyTeamsController::class, 'leaveEteam'])->name('myteams.leaveEteam');
    Route::get('/disolver-equipo/{Eteam}', [MyTeamsController::class, 'disolveEteam'])->name('myteams.disolveEteam');
});
