<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Managers\EteamInvitationManager;
use App\Http\Managers\EteamRequestManager;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamInvitation;
use App\Models\ETeamRequest;
use App\Models\ETeamUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyTeamsController extends Controller
{
    private EteamInvitationManager $eteamInvitationManager;
    private EteamRequestManager $eteamRequestManager;

    public function __construct(
        EteamInvitationManager $eteamInvitationManager,
        EteamRequestManager $eteamRequestManager
    )
    {
        $this->eteamInvitationManager = $eteamInvitationManager;
        $this->eteamRequestManager = $eteamRequestManager;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user)
        {
            $myTeams = $user->getMyEteams();
            $invitations = $user->getEteamsInvitations();
            $requests = $user->getEteamRequests();

            $viewParameters = [
                'user' => $user,
                'adminSomeTeam' => false,
                'myTeams' => $myTeams,
                'invitations' => $invitations,
                'requests' => $requests,
            ];
            if ($user->getMyTeamsWhereIamAdminIds()) {
                $myEteamsRequests = $user->getMyEteamsRequests();
                $myEteamsInvitations = $user->getMyEteamsInvitations();
                $viewParameters['adminSomeTeam'] = true;
                $viewParameters['requests'] = $requests;
                $viewParameters['myEteamsInvitations'] = $myEteamsInvitations;
                $viewParameters['myEteamsRequests'] = $myEteamsRequests;
            }

            return view('account.my-teams', $viewParameters);
        }

        return redirect()->route('home')->with('error', 'El usuario no existe');
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamInvitationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvitation(int $userId, int $eteamInvitationId): \Illuminate\Http\RedirectResponse
    {
        $eteamInvitation = ETeamInvitation::findOrFail($eteamInvitationId);
        $user = User::findOrFail($userId);

        return $this->eteamInvitationManager->acceptInvitation($user, $eteamInvitation);
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamInvitationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function declineInvitation(int $userId, int $eteamInvitationId): \Illuminate\Http\RedirectResponse
    {
        $eteamInvitation = ETeamInvitation::findOrFail($eteamInvitationId);
        $user = User::findOrFail($userId);

        return $this->eteamInvitationManager->declineInvitation($user, $eteamInvitation);
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamInvitationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyInvitation(int $eteamInvitationId): \Illuminate\Http\RedirectResponse
    {
        $eteamInvitation = ETeamInvitation::findOrFail($eteamInvitationId);

        return $this->eteamInvitationManager->destroyInvitation($eteamInvitation);
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamInvitationId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retireInvitation(int $userId, int $eteamInvitationId): \Illuminate\Http\RedirectResponse
    {
        $eteamInvitation = ETeamInvitation::findOrFail($eteamInvitationId);
        $user = User::findOrFail($userId);

        return $this->eteamInvitationManager->retireInvitation($user, $eteamInvitation);
    }

    public function _acceptRequest(ETeamRequest $eteamRequest)
    {
        $userAuthorized = Auth::user();
        $userName = $eteamRequest->user->name;
        $gameName = $eteamRequest->eteam->game->name;
        $eteamName = $eteamRequest->eteam->name;

        // check if user is member of other team with same game
        $userIsMemberOtherTeamWithSameGame = ETeamUser::select('eteams_users.id')
            ->join('eteams', 'eteams.id', '=', 'eteams_users.eteam_id')
            ->where('user_id', $eteamRequest->user_id)
            ->where('eteams.game_id', $eteamRequest->eteam->game_id)
            ->get();
        if ($userIsMemberOtherTeamWithSameGame->count() > 0) {
            $eteamRequest->delete();
            return back()->with("error", "$userName ya es miembro de otro equipo de '$gameName'. La solicitud ha sido eliminada...");
        }
        // END:check

        // add user in eteam
        ETeamUser::create([
            'eteam_id' => $eteamRequest->eteam_id,
            'user_id' => $eteamRequest->user_id,
            'contract_from' => $eteamRequest->contract_from,
            'contract_to' => $eteamRequest->contract_to,
        ]);
        // notify captains
        foreach ($eteamRequest->eteam->getCaptains() as $captain) {
            $notification_data = [
                'user_id' => $captain->user_id,
                'from_user_id' => null,
                'title' => "$userName, nuevo miembro de tu equipo '$eteamName'",
                'content' => "$userAuthorized->name ha aceptado la solicitud de ingreso y $userName es nuevo miembro de tu equipo '$eteamName'.",
                'link' => Route('eteams.eteam', $eteamRequest->eteam->slug),
                'link_title' => $eteamRequest->eteam->name,
                'read' => 0,
            ];
            storeNotification($notification_data);
        }
        // notify user
        foreach ($eteamRequest->eteam->getCaptains() as $captain) {
            $notification_data = [
                'user_id' => $eteamRequest->user_id,
                'from_user_id' => $userAuthorized->id,
                'title' => "Bienvenido a '$eteamName'!!",
                'content' => "Eres nuevo miembro de nuestro equipo '$eteamName' de $gameName. Puedes configurar tus datos de jugador desde el menú del equipo.",
                'link' => Route('eteams.eteam', $eteamRequest->eteam->slug),
                'link_title' => $eteamName,
                'read' => 0,
            ];
            storeNotification($notification_data);
        }
        // delete request
        $eteamRequest->delete();

        return back()->with("success", "$userName se ha unido a tu equipo '$gameName' correctamente.");
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamRequestId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptRequest(int $userId, int $eteamRequestId): \Illuminate\Http\RedirectResponse
    {
        $eteamRequest = ETeamRequest::findOrFail($eteamRequestId);
        $user = User::findOrFail($userId);

        return $this->eteamRequestManager->acceptRequest($user, $eteamRequest);
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamRequestId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function declineRequest(int $userId, int $eteamRequestId): \Illuminate\Http\RedirectResponse
    {
        $eteamRequest = ETeamRequest::findOrFail($eteamRequestId);
        $user = User::findOrFail($userId);

        return $this->eteamRequestManager->declineRequest($user, $eteamRequest);
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamRequestId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyRequest(int $eteamRequestId): \Illuminate\Http\RedirectResponse
    {
        $eteamRequest = ETeamRequest::findOrFail($eteamRequestId);

        return $this->eteamRequestManager->destroyRequest($eteamRequest);
    }

    /**
     * @param  int  $userId
     * @param  int  $eteamRequestId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retireRequest(int $userId, int $eteamRequestId): \Illuminate\Http\RedirectResponse
    {
        $eteamRequest = ETeamRequest::findOrFail($eteamRequestId);
        $user = User::findOrFail($userId);

        return $this->eteamRequestManager->retireRequest($user, $eteamRequest);
    }




    public function leaveEteam(EteamUser $eteamUser)
    {

        return back()->with('error', 'Próximamente...');

//        $eteam = $eteamUser->eteam;
//        $captain = $eteamUser->captain;
//
//        if ($eteam->users->count() === 1) {
//            if ($captain) {
//            }
//        }
        /**
         * check if it posible
         *
         * si es el unico miembro mensaje de que el equipo se va a disolver
         * si el usuario ha participado en algun torneo no se elimina, se desactiva, de esa manera si se puede abandonar a pesar que esté inscrito en algún torneo
         * ....
         */
    }

    public function disolveEteam(Team_Esport $eteam)
    {
        return back()->with('error', 'Próximamente...');
        /**
         * check if it posible
         *
         * el equipo no se puede disolver si ha participado en torneos, en ese caso se puede desactivar
         * en los torneos almacenar los eteams y sus participantes para el historial, de esa manera si se puede abandonar a pesar que esté inscrito en algún torneo
         * ....
         */
    }
}
