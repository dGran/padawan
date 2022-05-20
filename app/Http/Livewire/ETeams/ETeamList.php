<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamUser;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Auth;

class ETeamList extends Component
{
    public $name;
    public $game;
    public $users;
    public $order='name';
    public $orderName='name';
    public $orderSort='asc';
    public $view = 'table';

    protected $queryString = [
        'name' => ['except' => ''],
        'game' => ['except' => ''],
        'users' => ['except' => ''],
        'order' => ['except' => 'name']
    ];

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

    public function getMyEteams()
    {
        if (Auth::check()) {
            return $myEteams = Team_Esport::
                join('games', 'games.id', 'eteams.game_id')
                ->leftJoin('eteams_users', 'eteams_users.eteam_id', 'eteams.id')
                ->select('eteams.*')
                ->where('eteams_users.user_id', auth()->user()->id)
                ->orderBy($this->orderName, $this->orderSort)
                ->orderBy('name', 'asc')
                ->get();  
                // ->paginate(10)->onEachSide(2);
        }

        return false;
    }

    public function getEteams()
    {
        return Team_Esport::
            join('games', 'games.id', 'eteams.game_id')
            ->select('eteams.*')
            ->name($this->name)
            ->game($this->game)
            ->orderBy($this->orderName, $this->orderSort)
            ->orderBy('name', 'asc')
            ->get();    
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