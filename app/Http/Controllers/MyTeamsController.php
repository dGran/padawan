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
//        TODO leaveEteam
        return back()->with('info', 'Próximamente...');

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
//        TODO disolveEteam
        return back()->with('info', 'Próximamente...');
        /**
         * check if it posible
         *
         * el equipo no se puede disolver si ha participado en torneos, en ese caso se puede desactivar
         * en los torneos almacenar los eteams y sus participantes para el historial, de esa manera si se puede abandonar a pesar que esté inscrito en algún torneo
         * ....
         */
    }
}
