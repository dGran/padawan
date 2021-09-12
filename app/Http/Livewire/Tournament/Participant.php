<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Participant extends Component
{
    public function render()
    {
        return view('tournament.participants')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 1]);
    }

}