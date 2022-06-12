<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ETeam as Team_Esport;
use App\Models\ETeamInvitation;
use App\Models\ETeamRequest;
use App\Models\ETeamUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyTeamsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $myTeams =
            ETeamUser::with('eteam')
            ->where('user_id', $user->id)
            ->where('active', 1)
            ->orderBy('created_at', 'asc')
            ->get();

        $invitations = ETeamInvitation::where('user_id', $user->id)->where('state', 'pending')->orderBy('created_at', 'desc')->get();
        $requests = ETeamRequest::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        $myTeamsWhereIamCaptainIds = [];
        $myTeamsWhereIamCaptain = ETeamUser::select('eteam_id')
            ->where('user_id', $user->id)
            ->where('captain', 1)
            ->where('active', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($myTeamsWhereIamCaptain as $eteam) {
            $myTeamsWhereIamCaptainIds[] = $eteam->eteam_id;
        }

        $viewParameters = [
            'user' => $user,
            'adminSomeTeam' => false,
            'myTeams' => $myTeams,
            'invitations' => $invitations,
            'requests' => $requests,
        ];
        if (count($myTeamsWhereIamCaptainIds) > 0) {
            $myEteamsRequests = ETeamRequest::whereIn('eteam_id', $myTeamsWhereIamCaptainIds)->orderBy('created_at', 'desc')->get();
            $myEteamsInvitations = ETeamInvitation::whereIn('eteam_id', $myTeamsWhereIamCaptainIds)->orderBy('created_at', 'desc')->get();
            $viewParameters['adminSomeTeam'] = true;
            $viewParameters['requests'] = $requests;
            $viewParameters['myEteamsInvitations'] = $myEteamsInvitations;
            $viewParameters['myEteamsRequests'] = $myEteamsRequests;
        }

        return view('account.my-teams', $viewParameters);
    }

    public function acceptInvitation(ETeamInvitation $eteamInvitation)
    {
        $user = User::find(Auth::user()->id);
        $eteamName = $eteamInvitation->eteam->name;
        $eteamSlug = $eteamInvitation->eteam->slug;

        if (ETeamUser::where('eteam_id', $eteamInvitation->eteam_id)->where('user_id', $user->id)->count() === 0) {
            // add new user in the eteam
            ETeamUser::create([
                'eteam_id' => $eteamInvitation->eteam_id,
                'user_id' => $user->id,
                'contract_from' => $eteamInvitation->contract_from,
                'contract_to' => $eteamInvitation->contract_to,
                'active' => 1,
            ]);

            // notify the captains
            foreach ($eteamInvitation->eteam->getCaptains() as $captain) {
                //send notification with helper
                $notification_data = [
                    'user_id' => $captain->user_id,
                    'from_user_id' => null,
                    'title' => "$user->name, nuevo miembro de tu equipo '$eteamName'",
                    'content' => "$user->name ha aceptado la invitación y es nuevo miembro de tu equipo '$eteamName'",
                    'link' => Route('eteams.eteam', $eteamSlug),
                    'link_title' => $eteamName,
                    'read' => 0,
                ];
                storeNotification($notification_data);
            }

            // delete invitation
            $eteamInvitation->delete();

            return back()->with("success", "Felicidades!, eres nuevo miembro del equipo '$eteamName'.");
        }

        // delete invitation
        $eteamInvitation->delete();

        return back()->with("error", "Ya eres miembro del equipo '$eteamName'. Invitación eliminada.");
    }

    public function declineInvitation(ETeamInvitation $eteamInvitation)
    {
        $user = User::find(Auth::user()->id);
        $eteamName = $eteamInvitation->eteam->name;

        if (ETeamUser::where('eteam_id', $eteamInvitation->eteam_id)->where('user_id', $user->id)->count() === 0) {
            // notify the captains
            foreach ($eteamInvitation->eteam->getCaptains() as $captain) {
                $notification_data = [
                    'user_id' => $captain->user_id,
                    'from_user_id' => null,
                    'title' => "$user->name rechaza la invitación.",
                    'content' => "$user->name ha rechazado la invitación de ingreso en tu equipo '$eteamName'",
                    'link' => Route('myteams'),
                    'link_title' => 'Mis equipos',
                    'read' => 0,
                ];
                storeNotification($notification_data);
            }

            // change invitation state
            $eteamInvitation->state = 'refused';
            $eteamInvitation->save();

            return back()->with("info", "Has rechazado la invitación correctamente.");
        }

        // delete invitation
        $eteamInvitation->delete();

        return back()->with("error", "Ya eres miembro del equipo '$eteamName'. Invitación eliminada.");
    }

    public function acceptRequest(ETeamRequest $eteamRequest)
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

    public function declineRequest(ETeamRequest $eteamRequest)
    {
        dd('rechazada');
    }

    /**
     * nuevo campo para eteam, active
     * nuevo campo para eteanuser active
     */

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
