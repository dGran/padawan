<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Admin;

use App\Models\ETeam;
use App\Models\ETeamFile;
use Livewire\Component;
use Livewire\WithPagination;

class File extends Component
{
    use WithPagination;

    public $eteam;
    public $data = [];
    public $order = "created_at_desc";

    protected $queryString = [
        'order' => ['except' => 'created_at_desc']
    ];

    public function mount(Eteam $eteam)
    {
        $this->eteam = $eteam;
        $this->data['name'] = 'archivos';
    }

    public function render()
    {
        $files = $this->getData();
        $this->data['class'] = $files;

        return view('eteam.admin.files.index', [
            'files' => $files
        ]);
    }

    protected function getData()
    {
        return ETeamFile::select('eteams_multimedia.*', 'users.name as username')
            ->join('users', 'users.id', 'eteams_logs.user_id')
            ->where('eteam_id', $this->eteam->id)
            ->orderBy($this->getOrder()['field'], $this->getOrder()['direction'])
            ->paginate(3);
    }

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

    public function setOrder(string $value)
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
