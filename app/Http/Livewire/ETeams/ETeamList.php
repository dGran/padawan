<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamUser;
use Auth;

class ETeamList extends Component
{
    public $name, $game;

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

    public function render()
    {
        $eteams = Team_Esport::name($this->name)->orderBy('name', 'asc')->get();
        $myEteams = $this->getMyEteams();

        return view('eteams.list', [
                'eteams' => $eteams,
                'my_eteams' => $myEteams
            ])
            ->layout('layouts.app', ['title' => 'Equipos', 'breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 0]);
    }

}