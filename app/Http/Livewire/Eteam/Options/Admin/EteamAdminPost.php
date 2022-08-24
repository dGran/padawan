<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Http\Managers\EteamPostManager;
use App\Models\ETeam;
use App\Models\ETeamPost;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class EteamAdminPost extends Component
{
    use WithPagination;

    protected const PAGINATOR_DEFAULT = 15;

    public ETeam $eteam;
    public User $user;
    public array $data = [];
    public string $searchFilter = '';
    public string $visibilityFilter = 'all';
    public string $userFilter = 'all';
    public string $order = "created_at_desc";
    public bool $someFilterApplied = false;
    public bool $visiblePaginator = false;

    protected $listeners = ['store', 'update', 'delete'];

    protected $queryString = [
        'order' => ['except' => 'created_at_desc', 'as' => 'o'],
        'searchFilter' => ['except' => '', 'as' => 's'],
        'visibilityFilter' => ['except' => 'all', 'as' => 'v'],
        'userFilter' => ['except' => 'all', 'as' => 'u']
    ];

    // dependency injections
    public function getEteamPostManagerProperty(): EteamPostManager
    {
        return resolve(EteamPostManager::class);
    }

    public function mount(Eteam $eteam, User $user): void
    {
        $this->eteam = $eteam;
        $this->user = $user;
        $this->data['name'] = 'noticias';
    }

    public function render(): View
    {
        $regs = $this->getData();
        $this->data['class'] = $regs;
        $this->someFilterApplied = $this->someFilterApplied();
        $this->visiblePaginator = $this->visiblePaginator();

        return view('eteam.admin.posts.index');
    }

    protected function getData(): LengthAwarePaginator
    {
        return ETeamPost::select('eteams_posts.*', 'users.name as username')
            ->join('users', 'users.id', 'eteams_posts.user_id')
            ->where('eteam_id', $this->eteam->id)
            ->search($this->searchFilter)
            ->user($this->userFilter)
            ->visibility($this->visibilityFilter)
            ->orderBy($this->getOrder()['field'], $this->getOrder()['direction'])
            ->paginate(self::PAGINATOR_DEFAULT);
    }

    protected function someFilterApplied(): bool
    {
        return !empty($this->searchFilter) || $this->visibilityFilter !== 'all' || $this->userFilter !== 'all';
    }

    protected function visiblePaginator(): bool
    {
        return $this->data['class']->lastPage() > 1;
    }

    public function applySearchFilter(): void
    {
        $this->resetPage();
    }

    public function applyVisibilityFilter(int $public): void
    {
        $this->resetPage();
        $this->visibilityFilter = $public ? 'pública' : 'privada';
    }

    public function applyUserFilter(string $userName): void
    {
        $this->resetPage();
        $this->userFilter = $userName;
    }

    public function clearFilter(string $filter): void {
        $this->reset($filter);

        if ($filter === 'searchFilter') {
            $this->emit('focus-search');
        }
    }

    public function setOrder(string $value): void
    {
        $this->order = $value;
    }

    public function setCurrentPage(): void
    {
        $this->gotoPage($this->page);
    }

    public function toPage($page): void
    {
        $this->gotoPage($page);
    }

    public function nextPage(int $lastPage): void
    {
        if (($this->page + 1) <= $lastPage) {
            $this->setPage($this->page + 1);
        } else {
            $this->setPage(1);
        }
    }

    public function previousPage(int $lastPage): void
    {
        if ($this->page > 1) {
            $this->setPage($this->page - 1);
        } else {
            $this->setPage($lastPage);
        }
    }

    protected function getOrder(): array
    {
        $orderValues = EteamPostManager::ORDER_VALUES;

        return $orderValues[$this->order];
    }

    public function create(): void
    {
        $this->emit("openModal", "eteam.options.admin.eteam-admin-post-create-modal", ['eteamId' => $this->eteam->id, 'userId' => $this->user->id]);
    }

    public function view(int $eteamPostId): void
    {
        if ($this->eteamPostExists($eteamPostId)) {
            $this->emit("openModal", "eteam.options.admin.eteam-admin-post-view-modal", ['eteamPostId' => $eteamPostId]);
        }
    }

    public function edit(int $eteamPostId): void
    {
        if ($this->eteamPostExists($eteamPostId)) {
            $this->emit("openModal", "eteam.options.admin.eteam-admin-post-edit-modal", ['eteamPostId' => $eteamPostId]);
        }
    }

    public function remove(int $eteamPostId): void
    {
        if ($this->eteamPostExists($eteamPostId)) {
            $this->emit("openModal", "eteam.options.admin.eteam-admin-post-remove-modal", ['eteamPostId' => $eteamPostId]);
        }
    }

    public function store(array $data)
    {
        try {
            $this->eteamPostManager->create($data);

        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => EteamPostManager::STORE_FAILS_MESSAGE]);

            return;
        }

        $this->dispatchBrowserEvent('action-success', ['message' => EteamPostManager::STORED_MESSAGE]);
    }

    public function update(array $data, bool $hasChanges)
    {
        $logData = [
            'eteam_id' => $this->eteam->id,
            'user_id' => $this->user->id,
            'eteam_post_id' => $data['id']
        ];

        if (!$hasChanges) {
            $this->dispatchBrowserEvent('action-info', ['message' => EteamPostManager::UPDATE_NO_DIRTY_MESSAGE]);

            return;
        }

        try {
            $this->eteamPostManager->update($data, $logData);
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => EteamPostManager::UPDATE_FAILS_MESSAGE]);

            return;
        }

        $this->dispatchBrowserEvent('action-success', ['message' => EteamPostManager::UPDATED_MESSAGE]);
    }

    public function delete(int $eteamPostId, string $title): void
    {
        $logData = [
            'eteam_id' => $this->eteam->id,
            'user_id' => $this->user->id,
            'eteam_post_id' => $eteamPostId,
            'title' => $title
        ];

        try {
            $this->eteamPostManager->delete($eteamPostId, $logData);
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => EteamPostManager::POST_DELETE_FAILS]);

            return;
        }

        $this->dispatchBrowserEvent('action-success', ['message' => EteamPostManager::POST_DELETED]);
    }

    protected function eteamPostExists(int $eteamPostId): bool {
        $eteamPost = ETeamPost::find($eteamPostId);

        if (!$eteamPost) {
            $this->dispatchBrowserEvent('action-error', ['message' => EteamPostManager::REG_NOT_EXISTS]);

            return false;
        }

        return true;
    }
}
