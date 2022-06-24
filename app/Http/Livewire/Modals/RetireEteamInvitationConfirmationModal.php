<?php

namespace App\Http\Livewire\Modals;

use App\Models\ETeamInvitation;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class RetireEteamInvitationConfirmationModal extends ModalComponent
{
    public $eteamInvitation;
    public $user;

    public function mount(int $userId, int $eteamInvitationId)
    {
        $this->user = User::findOrFail($userId);
        $this->eteamInvitation = ETeamInvitation::findOrFail($eteamInvitationId);
    }

    public function render()
    {
        return view('modals.confirmations.retire-eteam-invitation-confirmation-modal');
    }
}
