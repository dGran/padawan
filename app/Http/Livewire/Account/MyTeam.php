<?php

namespace App\Http\Livewire\Account;

use App\Models\ETeamUser;
use Livewire\Component;
use App\Models\User;
use App\Models\ETeamInvitation;
use App\Models\ETeamRequest;

class MyTeam extends Component
{
    public $user;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
    }

    public function render()
    {
        $myTeams = ETeamUser::select('eteam_id')->where('user_id', $this->user->id)->where('captain', 1)->get();
        $myTeamIds = [];
        foreach ($myTeams as $eteam) {
            $myTeamIds = $eteam->eteam->id;
        }

        $myEteamsRequests = ETeamRequest::whereIn('eteam_id', [$myTeamIds])->get();

        $invitations = ETeamInvitation::where('user_id', $this->user->id)->get();
        $requests = ETeamRequest::where('user_id', $this->user->id)->get();

        return view('account.my-teams', [
            'invitations' => $invitations,
            'requests' => $requests,
            'myEteamsRequests' => $myEteamsRequests,
        ])->layout('layouts.app', ['breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

}
