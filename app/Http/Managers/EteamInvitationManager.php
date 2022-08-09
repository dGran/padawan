<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\ETeamInvitation;
use App\Models\ETeamLog;
use App\Models\ETeamUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EteamInvitationManager
{
    private User $user;
    private ETeamInvitation $eteamInvitation;
    private EteamPostManager $eteamPostManager;
    private EteamLogManager $eteamLogManager;
    private NotificationManager $notificationManager;

    public function __construct
    (
        EteamPostManager $eteamPostManager,
        EteamLogManager $eteamLogManager,
        NotificationManager $notificationManager
    ) {
        $this->eteamPostManager = $eteamPostManager;
        $this->eteamLogManager = $eteamLogManager;
        $this->notificationManager = $notificationManager;
    }

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
        $captainName = $eteamInvitation->captain->user->name;

        if (!$userIsEteamMember && !$userIsMemberEteamGame) {
            // add new user in the eteam
            ETeamUser::create([
                'eteam_id' => $eteamInvitation->eteam_id,
                'user_id' => $user->id,
                'contract_from' => $eteamInvitation->contract_from,
                'contract_to' => $eteamInvitation->contract_to,
                'active' => 1,
            ]);

            $this->eteamLogManager->create([
                'eteam_id' => $eteamInvitation->eteam_id,
                'user_id' => $user->id,
                'context' => ETeamLog::CONTEXT_INVITATIONS,
                'type' => ETeamLog::TYPE_UPDATE,
                'message' => "$user->name ha aceptado la invitación"
            ]);

            $this->eteamLogManager->create([
                'eteam_id' => $eteamInvitation->eteam_id,
                'user_id' => $user->id,
                'context' => ETeamLog::CONTEXT_MEMBERS,
                'type' => ETeamLog::TYPE_POST,
                'message' => "$user->name se ha unido al equipo"
            ]);

            $this->eteamPostManager->create([
                    'eteam_id' => $eteamInvitation->eteam_id,
                    'user_id' => $user->id,
                    'title' => "$user->name nuevo miembro del equipo",
                    'content' => "Ha aceptado la invitación de ingreso enviada por $captainName",
                    'public' => true
            ]);

            // notify the captains
            eteamCaptainsNotification(
                $eteamInvitation->eteam,
                null,
                "$user->name, nuevo miembro de tu equipo $eteamName",
                "$user->name ha aceptado la invitación y es nuevo miembro de tu equipo $eteamName",
                'eteams.eteam',
                [$eteamSlug],
                $eteamName
            );

            return back()->with("success", "Felicidades!, eres nuevo miembro del equipo $eteamName");
        }

        $this->eteamLogManager->create([
            'eteam_id' => $eteamInvitation->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_INVITATIONS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Invitación a $user->name eliminada al ser inválida"
        ]);

        $eteamInvitation->delete();

        if ($userIsEteamMember) {
            $message = "Ya eres miembro del equipo $eteamName";
        } else {
            $message = "Ya eres miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Invitación eliminada');
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
        $captainName = $eteamInvitation->captain->user->name;

        if (!$userIsEteamMember && !$userIsMemberEteamGame) {
            // notify the captains
            eteamCaptainsNotification(
                $eteamInvitation->eteam,
                null,
                "$user->name rechaza la invitación",
                "$user->name ha rechazado la invitación de ingreso en tu equipo $eteamName",
                'my-teams',
                null,
                'Mis equipos'
            );

            $this->eteamLogManager->create([
                'eteam_id' => $eteamInvitation->eteam_id,
                'user_id' => $user->id,
                'context' => ETeamLog::CONTEXT_INVITATIONS,
                'type' => ETeamLog::TYPE_UPDATE,
                'message' => "$user->name rechaza la invitación de ingreso"
            ]);

            $this->eteamPostManager->create([
                'eteam_id' => $eteamInvitation->eteam_id,
                'user_id' => $user->id,
                'title' => "$user->name rechaza la invitación",
                'content' => "Ha rechazado la invitación de ingreso enviada por $captainName",
                'public' => true
            ]);

            // change invitation state
            $eteamInvitation->state = 'refused';
            $eteamInvitation->save();

            return back()->with("success", "Has rechazado la invitación correctamente");
        }

        $this->eteamLogManager->create([
            'eteam_id' => $eteamInvitation->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_INVITATIONS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Invitación a $user->name eliminada al ser inválida"
        ]);

        $eteamInvitation->delete();

        if ($userIsEteamMember) {
            $message = "Ya eres miembro del equipo $eteamName";
        } else {
            $message = "Ya eres miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Invitación eliminada');
    }

    /**
     * @param  ETeamInvitation  $eteamInvitation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyInvitation(ETeamInvitation $eteamInvitation): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $invitedUserName = $eteamInvitation->user->name;

        $this->eteamLogManager->create([
            'eteam_id' => $eteamInvitation->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_INVITATIONS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Invitación a $invitedUserName eliminada al ser inválida"
        ]);

        $eteamInvitation->delete();

        return back()->with("success", 'Invitación eliminada');
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
            "Retirada la invitación de ingreso a $invitedUserName",
            "$user->name ha retirado la invitación de ingreso en tu equipo $eteamName a $invitedUserName",
            'my-teams',
            null,
            'Mis equipos'
        );

        // notify user
        $notification_data = [
            'user_id' => $eteamInvitation->user_id,
            'title' => "Retirada la invitación del equipo $eteamName",
            'content' => "$user->name ha retirado la invitación de ingreso al equipo $eteamName",
            'link' => Route('my-teams'),
            'link_title' => 'Mis equipos',
            'read' => 0,
        ];
        $this->notificationManager->create($notification_data);

        $this->eteamLogManager->create([
            'eteam_id' => $eteamInvitation->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_INVITATIONS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Invitación a $invitedUserName retirada"
        ]);

        $this->eteamPostManager->create([
            'eteam_id' => $eteamInvitation->eteam_id,
            'user_id' => $user->id,
            'title' => "Invitación retirada a $invitedUserName",
            'content' => "$user->name ha retirado la invitación de ingreso a $invitedUserName",
            'public' => false
        ]);

        $eteamInvitation->delete();

        return back()->with("success", 'Invitación retirada');
    }
}
