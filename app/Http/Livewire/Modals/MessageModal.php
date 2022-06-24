<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class MessageModal extends ModalComponent
{
    public $message;

    public function mount(string $message)
    {
        $this->message = $message;
    }

    public function render()
    {
        return view('modals.message-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
