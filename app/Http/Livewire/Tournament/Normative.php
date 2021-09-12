<?php

namespace App\Http\Livewire\Tournament;

use Livewire\Component;

class Normative extends Component
{
    public function render()
    {
        return view('tournament.normative')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 1]);
    }

}