<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeamPost;
use LivewireUI\Modal\ModalComponent;

class EteamAdminPostEditModal extends ModalComponent
{
    public $eteamPost;

    protected $rules = [
        'eteamPost.title' => 'required|string',
        'eteamPost.content' => 'required|string',
        'eteamPost.public' => 'required|integer|digits_between:0,1',
    ];

    protected $messages = [
        'eteamPost.title.required' => 'El título es obligatorio.',
        'eteamPost.content.required' => 'El contenido es obligatorio.',
        'eteamPost.public.required' => 'La visibilidad es obligatoria.',
        'eteamPost.public.digits_between' => 'La visibilidad debe ser pública o privada.',
    ];

    public function mount(EteamPost $eteamPostId)
    {
        $this->eteamPost = $eteamPostId;
    }

    public function render()
    {
        return view('modals.eteams.post-edit-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function update(): void
    {
        $this->validate();
        $isDirty = $this->eteamPost->isDirty();

        $this->emit('closeModal');
        $this->emit('update', $this->eteamPost, $isDirty);
    }
}
