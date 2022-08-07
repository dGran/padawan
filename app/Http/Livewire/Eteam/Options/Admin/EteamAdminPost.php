<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Http\Managers\EteamPostManager;
use App\Models\ETeam;
use App\Models\ETeamPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class EteamAdminPost extends Component
{
    use WithPagination;

    protected const PAGINATOR_DEFAULT = 15;
    protected const POST_DELETED = 'Noticia eliminada correctamente';
    protected const POST_DELETE_FAILS = 'Se ha producido un error al eliminar la noticia';
    protected const POST_UPDATED = 'Cambios guardados correctamente';
    protected const POST_UPDATE_FAILS = 'Se ha producido un error al guardar la noticia';
    protected const POST_UPDATE_NO_DIRTY = 'No se han detectado cambios';
    protected const REG_NOT_EXISTS = 'El registro ya no existe';

    public ETeam $eteam;
    public ETeamPost $eteamPost;
    public array $data = [];
    public string $searchFilter = '';
    public string $visibilityFilter = 'all';
    public string $order = "created_at_desc";
    public bool $someFilterApplied = false;
    public bool $visiblePaginator = false;

    protected $queryString = [
        'order' => ['except' => 'created_at_desc', 'as' => 'o'],
        'searchFilter' => ['except' => '', 'as' => 's'],
        'visibilityFilter' => ['except' => 'all', 'as' => 'v']
    ];

    protected $rules = [
        'eteamPost.title' => 'required|string',
        'eteamPost.content' => 'required|string',
        'eteamPost.public' => 'required|integer|digits_between:0,1',
    ];

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
        $orderValue =
            [
                'user' => [
                    'field' => 'username',
                    'direction' => 'asc',
                ],
                'user_desc' => [
                    'field' => 'username',
                    'direction' => 'desc',
                ],
                'visibility' => [
                    'field' => 'public',
                    'direction' => 'asc',
                ],
                'visibility_desc' => [
                    'field' => 'public',
                    'direction' => 'desc',
                ],
                'title' => [
                    'field' => 'title',
                    'direction' => 'asc',
                ],
                'title_desc' => [
                    'field' => 'title',
                    'direction' => 'desc',
                ],
                'content' => [
                    'field' => 'content',
                    'direction' => 'asc',
                ],
                'content_desc' => [
                    'field' => 'content',
                    'direction' => 'desc',
                ],
                'created_at' => [
                    'field' => 'created_at',
                    'direction' => 'asc',
                ],
                'created_at_desc' => [
                    'field' => 'created_at',
                    'direction' => 'desc',
                ]
            ];

        return $orderValue[$this->order];
    }

    public function edit(EteamPost $eteamPost): void
    {
        try {
            $this->eteamPost = $eteamPost;
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => self::REG_NOT_EXISTS]);

            return;
        }
    }

    public function update(): void
    {
        $isDirty = $this->eteamPost->isDirty();

        try {
            $this->validate();
            $this->eteamPostManager->update($this->eteamPost);

        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => self::POST_UPDATE_FAILS]);

            return;
        }

        if ($isDirty) {
            $this->dispatchBrowserEvent('action-success', ['message' => self::POST_UPDATED]);

            return;
        }

        $this->dispatchBrowserEvent('action-info', ['message' => self::POST_UPDATE_NO_DIRTY]);
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
}
