<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\ETeamRequest;
use App\Models\ETeamUser;
use App\Models\User;

class EteamRequestManager
{
    private User $user;
    private ETeamRequest $eteamRequest;

    /**
     * @param  User  $user
     * @param  ETeamRequest  $eteamRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptRequest(User $user, ETeamRequest $eteamRequest): \Illuminate\Http\RedirectResponse
    {
        $eteamName = $eteamRequest->eteam->name;
        $eteamSlug = $eteamRequest->eteam->slug;
        $userIsEteamMember = $eteamRequest->user->isEteamMember($eteamRequest->eteam_id);
        $userIsMemberEteamGame = $eteamRequest->user->isMemberEteamGame($eteamRequest->eteam->game_id);
        $requestUserName = $eteamRequest->user->name;

        if (!$userIsEteamMember && !$userIsMemberEteamGame) {
            // add new user in the eteam
            ETeamUser::create([
                'eteam_id' => $eteamRequest->eteam_id,
                'user_id' => $eteamRequest->user->id,
                'contract_from' => $eteamRequest->contract_from,
                'contract_to' => $eteamRequest->contract_to,
                'active' => 1,
            ]);

            // notify the captains
            eteamCaptainsNotification(
                $eteamRequest->eteam,
                $user->id,
                "$requestUserName, nuevo miembro de tu equipo '$eteamName'",
                "$user->name ha aceptado la solicitud de ingreso en tu equipo '$eteamName' a '$requestUserName'",
                'eteams.eteam',
                [$eteamSlug],
                $eteamName
            );

            // notify user
            $notification_data = [
                'user_id' => $eteamRequest->user_id,
                'from_user_id' => null,
                'title' => "Aceptada tu solicitud al equipo '$eteamName'",
                'content' => "Felicidades!, eres nuevo miembro del equipo '$eteamName', $user->name ha aceptado tu solicitud de ingreso.",
                'link' => Route('eteams.eteam', $eteamSlug),
                'link_title' => $eteamName,
                'read' => 0,
            ];
            storeNotification($notification_data);

            // delete invitation
            $eteamRequest->delete();

            return back()->with("success", "Felicidades!, $requestUserName es nuevo miembro de tu equipo '$eteamName'.");
        }

        $eteamRequest->delete();

        if ($userIsEteamMember) {
            $message = "$requestUserName ya es miembro del equipo '$eteamName'";
        } else {
            $message = "$requestUserName ya es miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Solicitud eliminada.');
    }

    /**
     * @param  User  $user
     * @param  ETeamRequest  $eteamRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function declineRequest(User $user, ETeamRequest $eteamRequest): \Illuminate\Http\RedirectResponse
    {
        $eteamName = $eteamRequest->eteam->name;
        $userIsEteamMember = $eteamRequest->user->isEteamMember($eteamRequest->eteam_id);
        $userIsMemberEteamGame = $eteamRequest->user->isMemberEteamGame($eteamRequest->eteam->game_id);
        $requestUserName = $eteamRequest->user->name;

        if (!$userIsEteamMember && !$userIsMemberEteamGame) {
            // notify the captains
            eteamCaptainsNotification(
                $eteamRequest->eteam,
                $user->id,
                "Rechazada la solicitud a '$requestUserName'.",
                "$user->name ha rechazado la solicitud de ingreso en tu equipo '$eteamName' a '$requestUserName'",
                'myteams',
                null,
                'Mis equipos'
            );
            // notify user
            $notification_data = [
                'user_id' => $eteamRequest->user_id,
                'from_user_id' => null,
                'title' => "Rechazada la solicitud al equipo '$eteamName'",
                'content' => "$user->name ha rechazado tu solicitud de ingreso al equipo a '$eteamName'",
                'link' => Route('myteams'),
                'link_title' => 'Mis equipos',
                'read' => 0,
            ];
            storeNotification($notification_data);

            // change invitation state
            $eteamRequest->state = 'refused';
            $eteamRequest->save();

            return back()->with("success", "Has rechazado la solicitud correctamente.");
        }

        $eteamRequest->delete();

        if ($userIsEteamMember) {
            $message = "$requestUserName ya eres miembro del equipo '$eteamName'";
        } else {
            $message = "$requestUserName ya eres miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Solicitud eliminada.');
    }

    /**
     * @param  User  $user
     * @param  ETeamRequest  $eteamRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyRequest(ETeamRequest $eteamRequest): \Illuminate\Http\RedirectResponse
    {
        $eteamRequest->delete();

        return back()->with("success", 'Solicitud eliminada.');
    }

    /**
     * @param  User  $user
     * @param  ETeamRequest  $eteamRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retireRequest(User $user, ETeamRequest $eteamRequest): \Illuminate\Http\RedirectResponse
    {
        $eteamName = $eteamRequest->eteam->name;

        // notify the captains
        eteamCaptainsNotification(
            $eteamRequest->eteam,
            null,
            "$user->name ha retirado la solicitud.",
            "$user->name ha retirado la solicitud de ingreso en tu equipo '$eteamName'",
            'myteams',
            null,
            'Mis equipos'
        );

        $eteamRequest->delete();

        return back()->with("success", 'Solicitud retirada.');
    }
}
