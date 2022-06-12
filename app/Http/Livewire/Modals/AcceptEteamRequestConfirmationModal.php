<?php

namespace App\Http\Livewire\Modals;

use App\Models\ETeamRequest;
use LivewireUI\Modal\ModalComponent;

class AcceptEteamRequestConfirmationModal extends ModalComponent
{
    public $eteamRequest;

    public function mount(ETeamRequest $eteamRequest)
    {
        $this->eteamRequest = $eteamRequest;
    }

    public function render()
    {
        return view('modals.confirmations.accept-eteam-request-confirmation-modal');
    }
}
