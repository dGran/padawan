<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\ETeamInvitation;
use App\Models\ETeamUser;
use App\Models\User;

class EteamInvitationManager
{
    private User $user;
    private ETeamInvitation $eteamInvitation;

    /**
     * @param  User  $user
     * @param  ETeamInvitation  $eteamInvitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvitation(User $user, ETeamInvitation $eteamInvitation): \Illuminate\Http\RedirectResponse
    {
        $eteamName = $eteamInvitation->eteam->name;
        $eteamSlug = $eteamInvitation->eteam->slug;
        $userIsEteamMember = $user->isEteamMember($eteamInvitation->eteam_id);
        $userIsMemberEteamGame = $user->isMemberEteamGame($eteamInvitation->eteam->game_id);

        if (!$userIsEteamMember && !$userIsMemberEteamGame) {
            // add new user in the eteam
            ETeamUser::create([
                'eteam_id' => $eteamInvitation->eteam_id,
                'user_id' => $user->id,
                'contract_from' => $eteamInvitation->contract_from,
                'contract_to' => $eteamInvitation->contract_to,
                'active' => 1,
            ]);
            // notify the captains
            eteamCaptainsNotification(
                $eteamInvitation->eteam,
                null,
                "$user->name, nuevo miembro de tu equipo '$eteamName'",
                "$user->name ha aceptado la invitación y es nuevo miembro de tu equipo '$eteamName'",
                'eteams.eteam',
                [$eteamSlug],
                $eteamName
            );

            return back()->with("success", "Felicidades!, eres nuevo miembro del equipo '$eteamName'.");
        }

        $eteamInvitation->delete();

        if ($userIsEteamMember) {
            $message = "Ya eres miembro del equipo '$eteamName'";
        } else {
            $message = "Ya eres miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Invitación eliminada.');
    }

    /**
     * @param  User  $user
     * @param  ETeamInvitation  $eteamInvitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function declineInvitation(User $user, ETeamInvitation $eteamInvitation): \Illuminate\Http\RedirectResponse
    {
        $eteamName = $eteamInvitation->eteam->name;
        $userIsEteamMember = $user->isEteamMember($eteamInvitation->eteam_id);
        $userIsMemberEteamGame = $user->isMemberEteamGame($eteamInvitation->eteam->game_id);

        if (!$userIsEteamMember && !$userIsMemberEteamGame) {
            // notify the captains
            eteamCaptainsNotification(
                $eteamInvitation->eteam,
                null,
                "$user->name rechaza la invitación.",
                "$user->name ha rechazado la invitación de ingreso en tu equipo '$eteamName'",
                'myteams',
                null,
                'Mis equipos'
            );

            // change invitation state
            $eteamInvitation->state = 'refused';
            $eteamInvitation->save();

            return back()->with("success", "Has rechazado la invitación correctamente.");
        }

        $eteamInvitation->delete();

        if ($userIsEteamMember) {
            $message = "Ya eres miembro del equipo '$eteamName'";
        } else {
            $message = "Ya eres miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Invitación eliminada.');
    }

    /**
     * @param  User  $user
     * @param  ETeamInvitation  $eteamInvitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyInvitation(ETeamInvitation $eteamInvitation): \Illuminate\Http\RedirectResponse
    {
        $eteamInvitation->delete();

        return back()->with("success", 'Invitación eliminada.');
    }

    /**
     * @param  User  $user
     * @param  ETeamInvitation  $eteamInvitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retireInvitation(User $user, ETeamInvitation $eteamInvitation): \Illuminate\Http\RedirectResponse
    {
        $eteamName = $eteamInvitation->eteam->name;
        $invitedUserName = $eteamInvitation->user->name;

        // notify the captains
        eteamCaptainsNotification(
            $eteamInvitation->eteam,
            null,
            "Retirada la invitación a '$invitedUserName'.",
            "$user->name ha retirado la invitación de ingreso en tu equipo '$eteamName' a '$invitedUserName'",
            'myteams',
            null,
            'Mis equipos'
        );

        // notify user
        $notification_data = [
            'user_id' => $eteamInvitation->user_id,
            'from_user_id' => null,
            'title' => "Retirada la invitación a '$eteamName'",
            'content' => "$user->name ha retirado la invitación de ingreso al equipo a '$eteamName'",
            'link' => Route('myteams'),
            'link_title' => 'Mis equipos',
            'read' => 0,
        ];
        storeNotification($notification_data);

        $eteamInvitation->delete();

        return back()->with("success", 'Invitación retirada.');
    }
}
