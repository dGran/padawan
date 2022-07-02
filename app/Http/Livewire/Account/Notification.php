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
    public $unread = false;
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
        'unread' => ['except' => false],
    ];

    public function setCurrentPage()
    {
        $this->gotoPage($this->page);
    }

    public function toPage($page)
    {
        $this->gotoPage($page);
    }

    public function nextPage($lastPage)
    {
        if (($this->page + 1) <= $lastPage) {
            $this->setPage($this->page + 1);
        } else {
            $this->setPage(1);
        }
    }

    public function previousPage($lastPage)
    {
        if ($this->page > 1) {
            $this->setPage($this->page - 1);
        } else {
            $this->setPage($lastPage);
        }
    }

    public function getNotifications()
    {
        return NotificationModel::
            where('user_id', auth()->user()->id)
            ->text($this->search)
            ->unread($this->unread)
            ->orderBy('notifications.created_at', 'desc')
            ->paginate(2);
    }

    public function countUnreadNotifications()
    {
        return NotificationModel::
            where('user_id', auth()->user()->id)
            ->where('read', false)
            ->text($this->search)
            ->orderBy('notifications.created_at', 'desc')
            ->count();
    }

    public function toggleUnread()
    {
        $this->resetPage();
        $this->unread = !$this->unread;
    }

    public function applySearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->reset('search');
        $this->emit('focus-search');
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
