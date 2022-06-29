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

    protected $queryString = [
        'filterText' => ['except' => ''],
        'filterUnread' => ['except' => false],
    ];

    public function getNotifications()
    {
        return NotificationModel::
            leftJoin('users', 'users.id', 'notifications.from_user_id')
            ->select('notifications.*', 'users.name as from_user_name')
            ->where('user_id', auth()->user()->id)
            ->text($this->filterText)
            ->unread($this->filterUnread)
            ->orderBy('notifications.created_at', 'desc')
            ->paginate(10)->onEachSide(2);
    }

    public function countUnreadNotifications()
    {
        return NotificationModel::
            leftJoin('users', 'users.id', 'notifications.from_user_id')
            ->select('notifications.*', 'users.name as from_user_name')
            ->where('user_id', auth()->user()->id)
            ->where('read', false)
            ->text($this->filterText)
            ->orderBy('notifications.created_at', 'desc')
            ->count();
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

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('account.notifications.list', [
            'notifications' => $this->getNotifications(),
            'countUnreadNotifications' => $this->countUnreadNotifications()
        ]);
    }
}
