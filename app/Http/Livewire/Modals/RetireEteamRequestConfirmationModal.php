<?php

namespace App\Http\Livewire\Modals;

use App\Models\ETeamRequest;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class RetireEteamRequestConfirmationModal extends ModalComponent
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
        return view('modals.confirmations.retire-eteam-request-confirmation-modal');
    }
}
