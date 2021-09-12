<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\User;

class MyTeam extends Component
{
    public $user;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('account.my-teams')
            ->layout('layouts.app', ['breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

}