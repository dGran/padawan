<?php

namespace App\Http\Livewire\Modals\Eteams;

use App\Models\ETeam;
use LivewireUI\Modal\ModalComponent;

class LeaveEteamConfirmationModal extends ModalComponent
{
    public $eteam;

    public function mount(ETeam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        return view('modals.confirmations.leave-eteam-confirmation-modal');
    }
}
