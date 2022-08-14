<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamPost;
use LivewireUI\Modal\ModalComponent;

class EteamAdminPostRemoveModal extends ModalComponent
{
    public $eteamPost;

    public function mount(EteamPost $eteamPostId)
    {
        $this->eteamPost = $eteamPostId;

    }

    public function render()
    {
        return view('modals.eteams.post-remove-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function delete(): void
    {
        $this->emit('closeModal');
        $this->emit('delete', $this->eteamPost->id, $this->eteamPost->title);
    }
}
