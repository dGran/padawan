<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Notification as NotificationModel;

class Notification extends Component
{
    use WithPagination;

    public $user;
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
        return $notifications = NotificationModel::
            leftJoin('users', 'users.id', 'notifications.from_user_id')
            ->select('notifications.*', 'users.name as from_user_name')
            ->where('user_id', auth()->user()->id)
            ->text($this->filterText)
            ->unread($this->filterUnread)
            ->orderBy('notifications.created_at', 'desc')
            ->paginate(10)->onEachSide(2);
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

    public function toggleFilterUnread()
    {
        $this->resetPage();
        $this->filterUnread = !$this->filterUnread;
    }

    public function applyFilterText()
    {
        $this->resetPage();
    }

    public function clearFilterText()
    {
        $this->reset('filterText');
        $this->emit('focus-filter-text');
    }

}