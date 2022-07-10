<?php

use App\Http\Controllers\MyTeamsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'mi-cuenta', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('profile');

    Route::group(['prefix' => 'notificaciones'], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications');
        Route::get('/{notification:slug}', [NotificationController::class, 'view'])->name('notifications.view');
        Route::get('/eliminar/{notification}', [NotificationController::class, 'delete'])->name('notifications.delete');
        Route::get('/toggle-read/{notification}', [NotificationController::class, 'toggleRead'])->name('notifications.toggleRead');
        Route::get('/marcar-todo-como-leido/{user}', [NotificationController::class, 'readAll'])->name('notifications.readAll');
    });
    Route::group(['prefix' => 'mis-equipos'], function () {
        Route::get('/', [MyTeamsController::class, 'index'])->name('my-teams');
        Route::get('/aceptar-invitacion/{userId}/{eteamInvitationId}', [MyTeamsController::class, 'acceptInvitation'])->name('my-teams.acceptInvitation');
        Route::get('/rechazar-invitacion/{userId}/{eteamInvitationId}', [MyTeamsController::class, 'declineInvitation'])->name('my-teams.declineInvitation');
        Route::get('/eliminar-invitacion/{eteamInvitationId}', [MyTeamsController::class, 'destroyInvitation'])->name('my-teams.destroyInvitation');
        Route::get('/retirar-invitacion/{userId}/{eteamInvitationId}', [MyTeamsController::class, 'retireInvitation'])->name('my-teams.retireInvitation');

        Route::get('/aceptar-solicitud/{userId}/{eteamRequestId}', [MyTeamsController::class, 'acceptRequest'])->name('my-teams.acceptRequest');
        Route::get('/rechazar-solicitud/{userId}/{eteamRequestId}', [MyTeamsController::class, 'declineRequest'])->name('my-teams.declineRequest');
        Route::get('/eliminar-solicitud/{eteamRequestId}', [MyTeamsController::class, 'destroyRequest'])->name('my-teams.destroyRequest');
        Route::get('/retirar-solicitud/{userId}/{eteamRequestId}', [MyTeamsController::class, 'retireRequest'])->name('my-teams.retireRequest');

        Route::get('/abandonar-equipo/{EteamUser}', [MyTeamsController::class, 'leaveEteam'])->name('my-teams.leaveEteam');
        Route::get('/disolver-equipo/{Eteam}', [MyTeamsController::class, 'disolveEteam'])->name('my-teams.disolveEteam');
    });
});
