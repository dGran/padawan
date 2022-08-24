<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamUser;
use LivewireUI\Modal\ModalComponent;

class EteamAdminMemberUpdateCaptainRangeModal extends ModalComponent
{
    public $eteamMember;
    public $action;

    public function mount(EteamUser $eteamMemberId, string $action)
    {
        $this->eteamMember = $eteamMemberId;
        $this->action = $action;
    }

    public function render()
    {
        if ($this->action === 'grant') {
            return view('modals.eteams.member-grant-captain-range-modal');
        }

        return view('modals.eteams.member-remove-captain-range-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function update(string $range): void
    {
        $this->emit('closeModal');
        $this->emit('updateRange', $this->eteamMember, $range);
    }
}
