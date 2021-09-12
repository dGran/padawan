<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Schedule extends Component
{
    public function render()
    {
        return view('tournament.schedule')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 1]);
    }

}