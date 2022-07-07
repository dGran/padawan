<?php

namespace App\Http\Livewire\Account\Profile\Forms;

use App\Models\User;
use Livewire\Component;

class Gamer extends Component
{
    public $user, $xbox_id, $ps_id, $steam_id;

    public function update()
    {
        $profile = $this->user->profile;

        $validatedData['xbox_id'] = $this->xbox_id ?: null;
        $validatedData['ps_id'] = $this->ps_id ?: null;
        $validatedData['steam_id'] = $this->steam_id ?: null;

        $profile->fill($validatedData);

        if ($profile->isDirty()) {
            if ($profile->update()) {
                $this->emit('update');
            } else {
                $this->emit('updateError');
            }
        } else {
            $this->emit('noDirty');
        }
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $profile = $user->profile;

        $this->xbox_id = $profile->xbox_id;
        $this->ps_id = $profile->ps_id;
        $this->steam_id = $profile->steam_id;
    }

    public function render()
    {
        return view('account.profile.gamer-data-form');
    }

}
