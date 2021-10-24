<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\User;
use App\Models\Notification as NotificationModel;

class CountUnreadNotifications extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $notifications = NotificationModel::where('user_id', $this->user->id)->unread(true)->count();
        return view('livewire.count-unread-notifications', ['notifications' => $notifications]);
    }
}
