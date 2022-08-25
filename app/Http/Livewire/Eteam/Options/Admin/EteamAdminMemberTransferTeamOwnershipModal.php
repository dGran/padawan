<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamUser;
use LivewireUI\Modal\ModalComponent;

class EteamAdminMemberTransferTeamOwnershipModal extends ModalComponent
{
    public $eteamMember;

    public function mount(EteamUser $eteamMemberId)
    {
        $this->eteamMember = $eteamMemberId;
    }

    public function render()
    {
        return view('modals.eteams.member-transfer-team-ownership-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function transferTeamOwnership(): void
    {
        $this->emit('closeModal');
        $this->emit('transferTeamOwnership', $this->eteamMember);
    }
}
