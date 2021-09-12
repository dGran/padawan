<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Stat extends Component
{
    public function render()
    {
        return view('tournament.stats')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 1]);
    }

}