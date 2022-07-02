<?php

namespace App\Http\Livewire\Account;

use App\Models\Country;
use Livewire\Component;
use App\Models\User;

class Profile extends Component
{
    public $user, $name, $email, $email_verified_at, $avatar, $birthdate, $country_id, $location, $whatsapp, $facebook, $instagram, $twitter, $twitch, $discord, $xbox_id, $ps_id, $origin_id, $steam_id, $notifications;
    public $photo;
    public $countries;

    protected function resetFields()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->email_verified_at = $this->user->email_verified_at;
        $this->avatar = $this->user->profile->avatar;
        $this->birthdate = $this->user->profile->birthdate;
        $this->country_id = $this->user->profile->country_id;
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
        $validatedData['name'] = $this->name ?: null;
        $validatedData['email'] = $this->email ?: null;
        $this->user->fill($validatedData);

        if ($this->user->isDirty()) {
            if ($this->user->update()) {
                $user_emit_state = "update";
            } else {
                $user_emit_state = "error";
            }
        } else {
            $user_emit_state = "noDirty";
        }

        $profile = $this->user->profile;

        $validatedProfileData['birthdate'] = $this->birthdate ?: null;
        $validatedProfileData['country_id'] = $this->country_id ?: null;
        $validatedProfileData['location'] = $this->location ?: null;
        $profile->fill($validatedProfileData);

        if ($profile->isDirty()) {
            if ($profile->update()) {
                $profile_emit_state = "update";
            } else {
                $profile_emit_state = "error";
            }
        } else {
            $profile_emit_state = "noDirty";
        }

        if ($user_emit_state == "update" || $profile_emit_state == "update") {
            $this->emit('updateGeneralData');
            return false;
        }
        if ($user_emit_state == "error" || $profile_emit_state == "error") {
            $this->emit('updateErrorGeneralData');
            return false;
        }
        if ($user_emit_state == "noDirty" || $profile_emit_state == "noDirty") {
            $this->emit('noDirtyGeneralData');
            return false;
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
            } else {
                $this->emit('updateErrorSocialData');
            }
        } else {
            $this->emit('noDirtySocialData');
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
            } else {
                $this->emit('updateErrorGamerData');
            }
        } else {
            $this->emit('noDirtyGamerData');
        }
    }

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $this->resetFields();
        $this->countries = Country::orderby('name')->get();
    }

    public function render()
    {
        return view('account.profile')
            ->layout('layouts.app', ['breadcrumb' => 0, 'wfooter' => 0, 'wloader' => 0]);
    }

}
