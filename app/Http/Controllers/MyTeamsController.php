<?php

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
        $myTeams = ETeamUser::select('eteam_id')->where('user_id', $user->id)->where('captain', 1)->orderBy('created_at', 'desc')->get();
        $myTeamIds = [];
        foreach ($myTeams as $eteam) {
            $myTeamIds = $eteam->eteam->id;
        }
        $myEteamsRequests = ETeamRequest::whereIn('eteam_id', [$myTeamIds])->orderBy('created_at', 'desc')->get();
        $invitations = ETeamInvitation::where('user_id', $user->id)->where('state', 'pending')->orderBy('created_at', 'desc')->get();
        $myEteamsInvitations = ETeamInvitation::whereIn('eteam_id', [$myTeamIds])->orderBy('created_at', 'desc')->get();
        $requests = ETeamRequest::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('account.my-teams', [
            'user' => $user,
            'invitations' => $invitations,
            'myEteamsInvitations' => $myEteamsInvitations,
            'requests' => $requests,
            'myEteamsRequests' => $myEteamsRequests,
        ]);
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
                //send notification with helper
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
        dd('aceptada');
    }

    public function declineRequest(ETeamRequest $eteamRequest)
    {
        dd('rechazada');
    }
}
