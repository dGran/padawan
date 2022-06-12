<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\Notification;

class NotificationModal extends ModalComponent
{
    public $notification;

    public function mount($id)
    {
        $this->notification = Notification::find($id);
    }

    public function render()
    {
        return view('modals.notification-modal');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
