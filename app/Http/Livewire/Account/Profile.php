<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    public $user;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('account.profile')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 0]);
    }

}
