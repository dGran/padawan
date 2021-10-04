<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use App\Models\ETeam as Team_Esport;

class ETeamList extends Component
{
    public $eteams;
    public $name, $game;

    public function render()
    {
        $this->eteams = Team_Esport::name($this->name)->orderBy('name', 'asc')->get();

        return view('eteams.list')
            ->layout('layouts.app', ['title' => 'Equipos', 'breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 0]);
    }

}