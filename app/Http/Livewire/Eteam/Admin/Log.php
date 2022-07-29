<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Admin;

use App\Models\ETeam;
use App\Models\ETeamLog;
use Livewire\Component;
use Livewire\WithPagination;

class Log extends Component
{
    use WithPagination;

    public $eteam;
    public $option = 'logs';

    public function mount(Eteam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        return view('eteam.admin.logs.index', [
            'logs' => $this->getLogs()
        ]);
    }

    protected $queryString = [
        'option' => [],
    ];

    protected function getLogs()
    {
        return ETeamLog::
        where('eteam_id', $this->eteam->id)
            ->orderBy('created_at', 'desc')
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
}
