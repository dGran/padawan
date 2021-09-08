<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;

class MyAccount extends Component
{
    public function render()
    {
        return view('account.my-account')
            ->layout('layouts.app', ['breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }
}
