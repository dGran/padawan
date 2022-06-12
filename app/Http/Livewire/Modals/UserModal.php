<?php

namespace App\Http\Livewire\Modals;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class UserModal extends ModalComponent
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('modals.user-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }
}
