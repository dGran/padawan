<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('tournament.dashboard')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 0]);
    }

}