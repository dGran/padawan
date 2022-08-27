<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamUser;
use LivewireUI\Modal\ModalComponent;

class EteamAdminMemberRemoveModal extends ModalComponent
{
    public $eteamMember;

    public function mount(EteamUser $eteamMemberId)
    {
        $this->eteamMember = $eteamMemberId;
    }

    public function render()
    {
        return view('modals.eteams.member-remove-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function remove(): void
    {
        $this->emit('closeModal');
        $this->emit('remove', $this->eteamMember);
    }
}
