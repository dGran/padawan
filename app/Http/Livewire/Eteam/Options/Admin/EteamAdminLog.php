<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeam;
use App\Models\ETeamLog;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class EteamAdminLog extends Component
{
    use WithPagination;

    protected const PAGINATOR_DEFAULT = 15;

    public ETeam $eteam;
    public array $data = [];
    public string $searchFilter = '';
    public string $contextFilter = '';
    public string $typeFilter = '';
    public bool $someFilterApplied = false;
    public bool $visiblePaginator = false;
    public string $order = "created_at_desc";

    protected $queryString = [
        'order' => ['except' => 'created_at_desc', 'as' => 'o'],
        'searchFilter' => ['except' => '', 'as' => 's'],
        'contextFilter' => ['except' => '', 'as' => 'c'],
        'typeFilter' => ['except' => '', 'as' => 't']
    ];

    public function mount(Eteam $eteam): void
    {
        $this->eteam = $eteam;
        $this->data['name'] = 'logs';
    }

    public function render(): View
    {
        $logs = $this->getData();
        $this->data['class'] = $logs;
        $this->someFilterApplied = $this->someFilterApplied();
        $this->visiblePaginator = $this->visiblePaginator();

        return view('eteam.admin.logs.index');
    }

    protected function getData(): LengthAwarePaginator
    {
        return ETeamLog::select('eteams_logs.*', 'users.name as username')
            ->join('users', 'users.id', 'eteams_logs.user_id')
            ->where('eteam_id', $this->eteam->id)
            ->search($this->searchFilter)
            ->context($this->contextFilter)
            ->type($this->typeFilter)
            ->orderBy($this->getOrder()['field'], $this->getOrder()['direction'])
            ->paginate(self::PAGINATOR_DEFAULT);
    }

    protected function someFilterApplied(): bool
    {
        return !empty($this->searchFilter) || !empty($this->contextFilter) || !empty($this->typeFilter);
    }

    protected function visiblePaginator(): bool
    {
        return $this->data['class']->lastPage() > 1;
    }

    public function applySearchFilter(): void
    {
        $this->resetPage();
    }

    public function applyContextFilter(string $context): void
    {
        $this->resetPage();
        $this->contextFilter = $context;
    }

    public function applyTypeFilter(string $type): void
    {
        $this->resetPage();
        $this->typeFilter = $type;
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

    public function toPage($page)
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
                'context' => [
                    'field' => 'context',
                    'direction' => 'asc',
                ],
                'context_desc' => [
                    'field' => 'context',
                    'direction' => 'desc',
                ],
                'type' => [
                    'field' => 'type',
                    'direction' => 'asc',
                ],
                'type_desc' => [
                    'field' => 'type',
                    'direction' => 'desc',
                ],
                'message' => [
                    'field' => 'message',
                    'direction' => 'asc',
                ],
                'message_desc' => [
                    'field' => 'message',
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
