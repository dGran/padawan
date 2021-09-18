<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Race extends Component
{

    public $op;
    public $color;
    public $positions;

    // queryString
    protected $queryString = [
        'op',
    ];

    public function changeTab($tab)
    {
        $this->op = $tab;
    }

    public function mount()
    {
        if (request()->op) { $this->op = request()->op; } else { $this->op = 'circuito'; }
        if (request()->color) { $this->color = request()->color; } else { $this->color = 'edgray'; }
    }

    public function render()
    {
        $this->positions = [
            3 => ['name' => 'Player 01'],
            2 => ['name' => 'Player 02'],
            5 => ['name' => 'Player 03'],
            4 => ['name' => 'Player 04'],
            5 => ['name' => 'Player 05'],
            1 => ['name' => 'Player 06'],
            7 => ['name' => 'Player 07'],
            8 => ['name' => 'Player 08'],
        ];

        return view('tournament.schedule.race')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 1]);
    }

}