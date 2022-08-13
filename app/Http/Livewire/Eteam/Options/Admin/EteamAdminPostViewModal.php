<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamPost;
use LivewireUI\Modal\ModalComponent;

class EteamAdminPostViewModal extends ModalComponent
{
    public $eteamPostId;

    public function mount(EteamPost $eteamPostId)
    {
        $this->eteamPost = $eteamPostId;
    }

    public function render()
    {
        return view('modals.eteams.view-post-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
