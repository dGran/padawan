<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamUser;
use LivewireUI\Modal\ModalComponent;

class EteamAdminMemberRemoveCaptainRangeModal extends ModalComponent
{
    public $eteamMember;

    public function mount(EteamUser $eteamMemberId)
    {
        $this->eteamMember = $eteamMemberId;
    }

    public function render()
    {
        return view('modals.eteams.member-remove-captain-range-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function update(): void
    {
        $this->emit('closeModal');
        $this->emit('updateRange', $this->eteamMember, 'member');
    }
}
