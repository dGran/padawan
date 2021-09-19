<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Race extends Component
{

    public $op;
    public $color;

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
        return view('tournament.schedule.race')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 1]);
    }

}