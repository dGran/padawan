<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account\Profile\Forms;

use App\Models\Country;
use App\Models\User;
use Livewire\Component;

class General extends Component
{
    public $user, $profile, $birthdate, $countryId, $location, $notifications;
    public $countries;

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update()
    {
        $profile = $this->user->profile;
        $validatedData['birthdate'] = $this->birthdate ?: null;
        $validatedData['country_id'] = $this->countryId ?: null;
        $validatedData['location'] = $this->location ?: null;
        $validatedData['notifications'] = $this->notifications;
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

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->profile = $user->profile;
        $this->birthdate = $this->profile->birthdate;
        $this->countryId = $this->profile->country_id;
        $this->location = $this->profile->location;
        $this->notifications = $this->profile->notifications;
        $this->countries = Country::orderby('name')->get();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('account.profile.general-data-form');
    }
}
