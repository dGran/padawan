<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeam;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EteamAdminPostCreateModal extends ModalComponent
{
    public ETeam $eteam;
    public User $user;
    public string $title = '';
    public string $content = '';
    public int $public = 1;

    protected $rules = [
        'title' => 'required|string',
        'content' => 'required|string',
        'public' => 'required|integer|digits_between:0,1',
    ];

    protected $messages = [
        'title.required' => 'El título es obligatorio',
        'content.required' => 'El contenido es obligatorio',
        'public.required' => 'La visibilidad es obligatoria',
        'public.digits_between' => 'La visibilidad debe ser pública o privada',
    ];

    public function mount(Eteam $eteamId, User $userId)
    {
        $this->eteam = $eteamId;
        $this->user = $userId;
    }

    public function render()
    {
        return view('modals.eteams.post-create-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function store(): void
    {
        $this->validate();

        $data = [
            'eteam_id' => $this->eteam->id,
            'user_id' => $this->user->id,
            'title' => $this->title,
            'content' => $this->content,
            'public' => $this->public
        ];

        $this->emit('closeModal');
        $this->emit('store', $data);
    }
}
