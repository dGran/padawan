<?php

namespace App\Http\Livewire\Account;

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
        $invitations = ETeamInvitation::where('user_id', $this->user->id)->get();
        $requests = ETeamRequest::where('user_id', $this->user->id)->get();

        return view('account.my-teams', [
            'invitations' => $invitations,
            'requests' => $requests
        ])->layout('layouts.app', ['breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

}