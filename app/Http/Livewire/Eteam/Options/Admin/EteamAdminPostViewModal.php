<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamPost;
use LivewireUI\Modal\ModalComponent;

class EteamAdminPostViewModal extends ModalComponent
{
    public $eteamPost;

    public function mount(EteamPost $eteamPostId)
    {
        $this->eteamPost = $eteamPostId;
    }

    public function render()
    {
        return view('modals.eteams.post-view-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
