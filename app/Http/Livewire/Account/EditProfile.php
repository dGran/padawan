<?php

namespace App\Http\Livewire\Account;

use Livewire\Component;
use App\Models\Profile;

class EditProfile extends Component
{
    public $user, $name, $email, $email_verified_at, $avatar, $birthdate, $location, $whatsapp, $facebook, $instagram, $twitter, $twitch, $discord, $xbox_id, $ps_id, $origin_id, $steam_id, $notifications;

    public function mount()
    {
        $this->user = auth()->user();
        if (!$this->user->profile) {
            $this->create_profile();
        }
        $this->resetFields();
    }

    public function render()
    {
        return view('account.edit-profile')
            ->layout('layouts.app', ['breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 1]);
    }

    protected function create_profile()
    {
        Profile::create([
            'user_id' => $this->user->id,
        ]);
    }

    protected function resetFields()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->email_verified_at = $this->user->email_verified_at;
        $this->avatar = $this->user->profile->avatar;
        $this->birthdate = $this->user->profile->birthdate;
        $this->location = $this->user->profile->location;
        $this->whatsapp = $this->user->profile->whatsapp;
        $this->facebook = $this->user->profile->facebook;
        $this->instagram = $this->user->profile->instagram;
        $this->twitter = $this->user->profile->twitter;
        $this->twitch = $this->user->profile->twitch;
        $this->discord = $this->user->profile->discord;
        $this->xbox_id = $this->user->profile->xbox_id;
        $this->ps_id = $this->user->profile->ps_id;
        $this->origin_id = $this->user->profile->origin_id;
        $this->steam_id = $this->user->profile->steam_id;
        $this->notifications = $this->user->profile->notifications;
    }

    public function updateGeneralData()
    {
        $profile = $this->user->profile;

        $validatedData['name'] = $this->name ?: null;
        $validatedData['email'] = $this->email ?: null;
        $validatedData['birthdate'] = $this->birthdate ?: null;
        $validatedData['location'] = $this->location ?: null;

        $profile->fill($validatedData);

        if ($profile->isDirty()) {
            if ($profile->update()) {
                $this->emit('updateSocialData');
            }
        }
    }

    public function updateSocialData()
    {
        $profile = $this->user->profile;

        $validatedData['whatsapp'] = $this->whatsapp ?: null;
        $validatedData['facebook'] = $this->facebook ?: null;
        $validatedData['twitter'] = $this->twitter ?: null;
        $validatedData['instagram'] = $this->instagram ?: null;
        $validatedData['twitch'] = $this->twitch ?: null;
        $validatedData['discord'] = $this->discord ?: null;

        $profile->fill($validatedData);

        if ($profile->isDirty()) {
            if ($profile->update()) {
                $this->emit('updateSocialData');
            }
        }
    }

    public function updateGamerData()
    {
        $profile = $this->user->profile;

        $validatedData['ps_id'] = $this->ps_id ?: null;
        $validatedData['xbox_id'] = $this->xbox_id ?: null;
        $validatedData['steam_id'] = $this->steam_id ?: null;
        $validatedData['origin_id'] = $this->origin_id ?: null;

        $profile->fill($validatedData);

        if ($profile->isDirty()) {
            if ($profile->update()) {
                $this->emit('updateGamerData');
            }
        }
    }
}