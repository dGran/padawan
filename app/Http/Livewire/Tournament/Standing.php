<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Standing extends Component
{
    public function render()
    {
        return view('tournament.standings')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 1]);
    }

}