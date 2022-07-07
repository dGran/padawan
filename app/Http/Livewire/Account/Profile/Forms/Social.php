<?php

namespace App\Http\Livewire\Account\Profile\Forms;

use App\Models\User;
use Livewire\Component;

class Social extends Component
{
    public $user, $whatsapp, $facebook, $instagram, $twitter, $twitch, $discord;

    public function update()
    {
        $profile = $this->user->profile;

        $validatedData['whatsapp'] = $this->whatsapp ?: null;
        $validatedData['facebook'] = $this->facebook ?: null;
        $validatedData['instagram'] = $this->instagram ?: null;
        $validatedData['twitter'] = $this->twitter ?: null;
        $validatedData['twitch'] = $this->twitch ?: null;
        $validatedData['discord'] = $this->discord ?: null;

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

        $this->whatsapp = $profile->whatsapp;
        $this->facebook = $profile->facebook;
        $this->instagram = $profile->instagram;
        $this->twitter = $profile->twitter;
        $this->twitch = $profile->twitch;
        $this->discord = $profile->discord;
    }

    public function render()
    {
        return view('account.profile.social-data-form');
    }

}
