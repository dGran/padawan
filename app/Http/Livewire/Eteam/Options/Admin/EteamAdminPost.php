<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Http\Managers\EteamPostManager;
use App\Models\ETeam;
use App\Models\ETeamPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class EteamAdminPost extends Component
{
    use WithPagination;

    protected const PAGINATOR_DEFAULT = 15;
    protected const POST_DELETED = 'Noticia eliminada correctamente';
    protected const POST_DELETE_FAILS = 'Se ha producido un error al eliminar la noticia';

    public ETeam $eteam;
    public array $data = [];
    public string $searchFilter = '';
    public string $visibilityFilter = 'all';
    public string $order = "created_at_desc";
    public bool $someFilterApplied = false;
    public bool $visiblePaginator = false;

    protected $listeners = ['update'];

    protected $queryString = [
        'order' => ['except' => 'created_at_desc', 'as' => 'o'],
        'searchFilter' => ['except' => '', 'as' => 's'],
        'visibilityFilter' => ['except' => 'all', 'as' => 'v']
    ];

    // dependency injections
    public function getEteamPostManagerProperty(): EteamPostManager
    {
        return resolve(EteamPostManager::class);
    }

    public function mount(Eteam $eteam): void
    {
        $this->eteam = $eteam;
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
            ->visibility($this->visibilityFilter)
            ->orderBy($this->getOrder()['field'], $this->getOrder()['direction'])
            ->paginate(self::PAGINATOR_DEFAULT);
    }

    protected function someFilterApplied(): bool
    {
        return !empty($this->searchFilter) || $this->visibilityFilter !== 'all';
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

    public function edit(EteamPost $eteamPost): void
    {
        try {
            $this->eteamPost = $eteamPost;
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => EteamPostManager::REG_NOT_EXISTS]);

            return;
        }
    }

    public function show(int $eteamPostId): void
    {
        $this->eteamPost = EteamPost::find($eteamPostId);
    }

    public function delete(EteamPost $eteamPost): void
    {
        try {
            $this->eteamPost = $eteamPost;
            $this->eteamPostManager->delete($eteamPost);
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => self::POST_DELETE_FAILS]);

            return;
        }

        $this->dispatchBrowserEvent('action-success', ['message' => self::POST_DELETED]);
    }

    public function update(array $data, bool $hasChanges)
    {
        if (!$hasChanges) {
            $this->dispatchBrowserEvent('action-info', ['message' => EteamPostManager::UPDATE_NO_DIRTY_MESSAGE]);

            return;
        }

        $eteamPost = ETeamPost::find($data['id']);

        if (!$eteamPost) {
            $this->dispatchBrowserEvent('action-success', ['message' => EteamPostManager::REG_NOT_EXISTS]);

            return;
        }

        try {
            $this->eteamPostManager->update($eteamPost, $data);

        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => EteamPostManager::UPDATE_FAILS_MESSAGE]);

            return;
        }

        $this->dispatchBrowserEvent('action-success', ['message' => EteamPostManager::UPDATED_MESSAGE]);
    }
}
