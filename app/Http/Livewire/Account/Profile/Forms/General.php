<?php

namespace App\Http\Livewire\Account\Profile\Forms;

use App\Models\Country;
use App\Models\User;
use Livewire\Component;

class General extends Component
{
    public $user, $avatar, $avatarUrl, $birthdate, $country_id, $location, $notifications;
    public $photo;
    public $countries;

    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return "https://eu.ui-avatars.com/api/?name=" . $this->user->name;
        }

        return $this->avatar;
    }


    public function update()
    {
        $profile = $this->user->profile;

        $validatedData['birthdate'] = $this->birthdate ?: null;
        $validatedData['country_id'] = $this->country_id ?: null;
        $validatedData['location'] = $this->location ?: null;
        $validatedData['notifications'] = $this->notifications ?: false;
        $profile->fill($validatedData);

        $this->avatarUrl = $this->getAvatarUrl();

        if ($profile->isDirty()) {
            if ($profile->update()) {
                $emitState = "update";
            } else {
                $emitState = "error";
            }
        } else {
            $emitState = "noDirty";
        }

        if ($emitState == "update") {
            $this->emit('update');
            return false;
        }
        if ($emitState == "error") {
            $this->emit('updateError');
            return false;
        }
        if ($emitState == "noDirty") {
            $this->emit('noDirty');
            return false;
        }
    }

    public function mount(User $user)
    {
        $this->user = $user;

        $this->avatar = $this->user->profile->avatar;
        $this->avatarUrl = $this->getAvatarUrl();
        $this->birthdate = $this->user->profile->birthdate;
        $this->country_id = $this->user->profile->country_id;
        $this->location = $this->user->profile->location;
        $this->notifications = $this->user->profile->notifications;

        $this->countries = Country::orderby('name')->get();
    }

    public function render()
    {
        return view('account.profile.general-data-form');
    }

}
