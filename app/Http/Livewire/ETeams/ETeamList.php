<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamUser;
use App\Models\Game;
use Auth;

class ETeamList extends Component
{
    public $name, $game;
    public $view = 'table';

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
                leftJoin('eteams_users', 'eteams_users.eteam_id', 'eteams.id')
                ->select('eteams.*')
                ->where('eteams_users.user_id', auth()->user()->id)
                ->orderBy('name', 'asc')
                // ->orderBy('eteams.created_at', 'desc')
                ->get();
                // ->paginate(10)->onEachSide(2);
        }

        return false;
    }

    public function getEteams()
    {
        return Team_Esport::
            leftJoin('games', 'games.id', 'eteams.game_id')
            ->select('eteams.*')
            ->name($this->name)
            ->game($this->game)
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