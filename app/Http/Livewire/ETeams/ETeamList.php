<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use App\Models\ETeam as Team_Esport;
use Livewire\WithPagination;
use Auth;

class ETeamList extends Component
{
    use WithPagination;

    /* order vars */
    public $order="name";
    public $orderName="name";
    public $orderSort="asc";
    /* filters vars */
    public $view="table";
    public $search;
    public $game;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'game' => ['except' => ''],
        'order' => ['except' => 'name']
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

    public function changeOrder(string $value)
    {
        if (substr($this->order, -5)==='_desc') {
            $this->order=$value;
            $this->orderSort='asc';
        } else {
            $this->order=$value.'_desc';
            $this->orderSort='desc';
        }
        $this->orderName=$value;
    }

    public function toggleView()
    {
        if ($this->view == 'table') {
            $this->view = 'card';
        } else {
            $this->view = 'table';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingGame()
    {
        $this->resetPage();
    }

    public function getMyEteams()
    {
        if (Auth::check()) {
            return Team_Esport::
                leftJoin('games', 'games.id', 'eteams.game_id')
                ->leftJoin('eteams_users', 'eteams_users.eteam_id', 'eteams.id')
                ->select('eteams.*')
                ->where('eteams_users.user_id', auth()->user()->id)
                ->orderBy('name', 'asc')
                ->get();
                // ->paginate(10)->onEachSide(2);
        }

        return false;
    }

    public function getEteams()
    {
        $eteams = Team_Esport::
            withCount('users')
            ->leftJoin('games', 'games.id', 'eteams.game_id')
            ->search($this->search)
            ->game($this->game)
            ->orderBy($this->orderName, $this->orderSort)
            ->orderBy('name', 'asc')            
            ->paginate(12);  
              
        return $eteams;
    }

    public function mount()
    {
    }

    public function render()
    {
        $etGames = Team_Esport::leftJoin('games', 'games.id', 'eteams.game_id')
            ->select('eteams.game_id', 'games.name')
            ->distinct()
            ->orderBy('games.name', 'asc')
            ->get();

        return view('eteams.list',
            [
                'eteams'     => $this->getEteams(),
                'my_eteams'  => $this->getMyEteams(),
                'etGames'    => $etGames
            ]
        )->layout('layouts.app',
            [
                'title'      => 'Equipos',
                'breadcrumb' => 0,
                'wfooter'    => 0,
                'wloader'    => 0
            ]
        );
    }

}