<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Models\ETeamLog;
use App\Models\ETeamRequest;
use App\Models\ETeamUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EteamRequestManager
{
    private User $user;
    private ETeamRequest $eteamRequest;
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

            $this->eteamLogManager->create([
                'eteam_id' => $eteamRequest->eteam_id,
                'user_id' => $user->id,
                'context' => ETeamLog::CONTEXT_REQUESTS,
                'type' => ETeamLog::TYPE_DELETE,
                'message' => "$user->name ha aceptado la solicitud de $requestUserName"
            ]);

            $this->eteamLogManager->create([
                'eteam_id' => $eteamRequest->eteam_id,
                'user_id' => $user->id,
                'context' => ETeamLog::CONTEXT_MEMBERS,
                'type' => ETeamLog::TYPE_POST,
                'message' => "$requestUserName se ha unido al equipo"
            ]);

            $this->eteamPostManager->create([
                'eteam_id' => $eteamRequest->eteam_id,
                'user_id' => $user->id,
                'title' => "$requestUserName nuevo miembro del equipo",
                'content' => "$user->name ha aceptado la solicitud de ingreso",
                'public' => true
            ]);

            // notify the captains
            $this->notificationManager->createToEteamAdmins($eteamRequest->eteam, [
                'title' => "$requestUserName, nuevo miembro de tu equipo $eteamName",
                'content' => "$user->name ha aceptado la solicitud de ingreso en tu equipo $eteamName a $requestUserName",
                'link' => 'eteam',
                'linkParams' => [$eteamSlug],
                'linkTitle' => $eteamName
            ]);

            // notify user
            $notification_data = [
                'user_id' => $eteamRequest->user_id,
                'title' => "Aceptada tu solicitud al equipo '$eteamName'",
                'content' => "Felicidades!, eres nuevo miembro del equipo $eteamName, $user->name ha aceptado tu solicitud de ingreso",
                'link' => Route('eteams.eteam', $eteamSlug),
                'link_title' => $eteamName,
                'read' => 0,
            ];
            $this->notificationManager->create($notification_data);

            // delete request
            $eteamRequest->delete();

            return back()->with("success", "Felicidades!, $requestUserName es nuevo miembro de tu equipo '$eteamName'");
        }

        $this->eteamLogManager->create([
            'eteam_id' => $eteamRequest->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_REQUESTS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Solicitud de $requestUserName eliminada al ser inválida"
        ]);

        $eteamRequest->delete();

        if ($userIsEteamMember) {
            $message = "$requestUserName ya es miembro del equipo $eteamName";
        } else {
            $message = "$requestUserName ya es miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Solicitud eliminada');
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
            $this->notificationManager->createToEteamAdmins($eteamRequest->eteam, [
                'title' => "Rechazada la solicitud a $requestUserName",
                'content' => "$user->name ha rechazado la solicitud de ingreso en tu equipo '$eteamName' a $requestUserName",
                'link' => 'my-teams',
                'linkParams' => null,
                'linkTitle' => 'Mis equipos'
            ]);

            // notify user
            $notification_data = [
                'user_id' => $eteamRequest->user_id,
                'title' => "Rechazada la solicitud al equipo $eteamName",
                'content' => "$user->name ha rechazado tu solicitud de ingreso al equipo a $eteamName",
                'link' => Route('my-teams'),
                'link_title' => 'Mis equipos',
                'read' => 0,
            ];
            $this->notificationManager->create($notification_data);


            $this->eteamLogManager->create([
                'eteam_id' => $eteamRequest->eteam_id,
                'user_id' => $user->id,
                'context' => ETeamLog::CONTEXT_REQUESTS,
                'type' => ETeamLog::TYPE_UPDATE,
                'message' => "$user->name rechaza la solicitud de ingreso de $requestUserName"
            ]);

            $this->eteamPostManager->create([
                'eteam_id' => $eteamRequest->eteam_id,
                'user_id' => $user->id,
                'title' => "$user->name rechaza la solicitud",
                'content' => "Ha rechazado la solicitud de ingreso enviada por $requestUserName",
                'public' => true
            ]);

            // change request state
            $eteamRequest->state = 'refused';
            $eteamRequest->save();

            return back()->with("success", "Has rechazado la solicitud correctamente");
        }

        $this->eteamLogManager->create([
            'eteam_id' => $eteamRequest->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_REQUESTS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Solicitud de $requestUserName eliminada al ser inválida"
        ]);

        $eteamRequest->delete();

        if ($userIsEteamMember) {
            $message = "$requestUserName ya eres miembro del equipo '$eteamName'";
        } else {
            $message = "$requestUserName ya eres miembro de otro equipo del mismo juego";
        }

        return back()->with("error", $message.'.Solicitud eliminada');
    }

    /**
     * @param  User  $user
     * @param  ETeamRequest  $eteamRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyRequest(ETeamRequest $eteamRequest): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $requestUserName = $eteamRequest->user->name;

        $this->eteamLogManager->create([
            'eteam_id' => $eteamRequest->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_REQUESTS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Solicitud de $requestUserName eliminada al ser inválida"
        ]);

        $eteamRequest->delete();

        return back()->with("success", 'Solicitud eliminada');
    }

    /**
     * @param  User  $user
     * @param  ETeamRequest  $eteamRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retireRequest(User $user, ETeamRequest $eteamRequest): \Illuminate\Http\RedirectResponse
    {
        $eteamName = $eteamRequest->eteam->name;
        $requestUserName = $eteamRequest->user->name;

        // notify the captains
        $this->notificationManager->createToEteamAdmins($eteamRequest->eteam, [
            'title' => "$user->name ha retirado la solicitud",
            'content' => "$user->name ha retirado la solicitud de ingreso en tu equipo $eteamName",
            'link' => 'my-teams',
            'linkParams' => null,
            'linkTitle' => 'Mis equipos'
        ]);

        $this->eteamLogManager->create([
            'eteam_id' => $eteamRequest->eteam_id,
            'user_id' => $user->id,
            'context' => ETeamLog::CONTEXT_REQUESTS,
            'type' => ETeamLog::TYPE_DELETE,
            'message' => "Solicitud de $requestUserName retirada"
        ]);

        $this->eteamPostManager->create([
            'eteam_id' => $eteamRequest->eteam_id,
            'user_id' => $user->id,
            'title' => "Solicitud de $requestUserName retirada",
            'content' => "$requestUserName ha retirado la solicitud de ingreso",
            'public' => false
        ]);

        $eteamRequest->delete();

        return back()->with("success", 'Solicitud retirada');
    }
}
