<?php

namespace App\Http\Livewire\Modals\Eteams;

use App\Models\ETeamRequest;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DeclineMyEteamRequestConfirmationModal extends ModalComponent
{
    public $eteamRequest;
    public $user;

    public function mount(int $userId, int $eteamRequestId)
    {
        $this->user = User::findOrFail($userId);
        $this->eteamRequest = ETeamRequest::findOrFail($eteamRequestId);
    }

    public function render()
    {
        return view('modals.confirmations.decline-my-eteam-request-confirmation-modal');
    }
}
