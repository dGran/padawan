<?php

namespace App\Http\Livewire\Modals\Eteams;

use App\Models\ETeam;
use LivewireUI\Modal\ModalComponent;

class DisolveEteamConfirmationModal extends ModalComponent
{
    public $eteam;

    public function mount(ETeam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        return view('modals.confirmations.disolve-eteam-confirmation-modal');
    }
}
