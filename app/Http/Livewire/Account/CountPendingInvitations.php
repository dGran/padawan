<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\User;
use App\Models\ETeamInvitation;

class CountPendingInvitations extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $invitations = ETeamInvitation::where('user_id', $this->user->id)->where('state', 'pending')->count();
        return view('livewire.count-pending-invitations', ['invitations' => $invitations]);
    }
}
