<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeam;
use App\Models\ETeamPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class EteamAdminPost extends Component
{
    use WithPagination;

    public ETeam $eteam;
    public array $data = [];
    public string $searchFilter = '';
    public string $visibilityFilter = 'all';
    public bool $someFilterApplied = false;
    public bool $visiblePaginator = false;
    public string $order = "created_at_desc";
    protected int $paginator = 15;

    protected $queryString = [
        'order' => ['except' => 'created_at_desc', 'as' => 'o'],
        'searchFilter' => ['except' => '', 'as' => 's'],
        'visibilityFilter' => ['except' => 'all', 'as' => 'p']
    ];

    public function mount(Eteam $eteam): void
    {
        $this->eteam = $eteam;
        $this->data['name'] = 'noticias';
    }

    public function render(): View
    {
        $posts = $this->getData();
        $this->data['class'] = $posts;
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
            ->paginate($this->paginator);
    }

    protected function someFilterApplied(): bool
    {
        if (!empty($this->searchFilter) || $this->visibilityFilter !== 'all') {
            return true;
        }

        return false;
    }

    protected function visiblePaginator(): bool
    {
        if ($this->data['class']->lastPage() > 1) {
            return true;
        }

        return false;
    }

    public function applySearchFilter(): void
    {
        $this->resetPage();
    }

    public function clearFilter(string $filter): void {
        $this->reset($filter);

        if ($filter === 'searchFilter') {
            $this->emit('focus-search');
        }
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

    public function setOrder(string $value): void
    {
        $this->order = $value;
    }

    protected function getOrder(): array
    {
        (array) $orderValue = [
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
}
