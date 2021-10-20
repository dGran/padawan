<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\User;
use App\Models\Notification as NotificationModel;

class Notification extends Component
{
    public $user;
    public $notifications;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
    }

    public function render()
    {
        $this->notifications = $this->getNotifications();

        return view('account.notifications')
            ->layout('layouts.app', ['breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

    public function getNotifications()
    {
        return $notifications = NotificationModel::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    }

}