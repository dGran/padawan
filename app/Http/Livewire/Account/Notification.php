<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Notification as NotificationModel;
use Faker\Generator as Faker;

class Notification extends Component
{
    use WithPagination;

    public $user;
    // public $notifications;
    public $filterUnread = false;
    public $filterText;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('account.notifications', ['notifications' => $this->getNotifications()])
            ->layout('layouts.app', ['breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

    public function getNotifications()
    {
        $notifications = NotificationModel::where('user_id', auth()->user()->id)->text($this->filterText)->unread($this->filterUnread)->orderBy('created_at', 'desc')->paginate(8);
        return $notifications;
    }

    public function toggleRead($id)
    {
        $notification = NotificationModel::find($id);
        $notification->read = !$notification->read;
        $notification->save();
    }

    public function readAll()
    {
        $notifications = NotificationModel::all();
        foreach ($notifications as $notification) {
            $notification->read = 1;
            $notification->save();
        }
    }

    public function open($id)
    {
        $this->emit("openModal", "modals.notification-modal", ["id" => $id]);

        $notification = NotificationModel::find($id);
        $notification->read = 1;
        $notification->save();
    }

    public function delete($id)
    {
        $notification = NotificationModel::find($id);
        $notification->delete();
    }

    public function addNotification(Faker $faker)
    {
        $notification_data = [
            'user_id' => $this->user->id,
            'from_user_id' => null,
            'title' => $faker->sentence(),
            'content' => $faker->text(),
            'link' => null,
            'read' => 0
        ];

        storeNotification($notification_data);
    }

    public function toggleFilterUnread()
    {
        $this->filterUnread = !$this->filterUnread;
    }

}