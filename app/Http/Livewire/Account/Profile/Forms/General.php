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

        $this->avatar = $profile->avatar;
        $this->avatarUrl = $this->getAvatarUrl();
        $this->birthdate = $profile->birthdate;
        $this->country_id = $profile->country_id;
        $this->location = $profile->location;
        $this->notifications = $profile->notifications;

        $this->countries = Country::orderby('name')->get();
    }

    public function render()
    {
        return view('account.profile.general-data-form');
    }

}
