<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account\Profile\Forms;

use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class General extends Component
{
    use WithFileUploads;

    public $user, $profile, $avatar, $birthdate, $countryId, $location, $notifications;
    public $avatarPreview;
    public $countries;

    protected $rules = [
        'avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:1024'
    ];

    protected $messages = [
        'avatar.mimes' => 'El avatar debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
        'avatar.max' => 'El tamaño del avatar no puede ser mayor a 1024 bytes',
    ];

    public function uploadAvatar(): void
    {
        $validation = $this->validate();
    }

    public function initializeAvatar(): void {
        $this->avatar = null;
        $this->avatarPreview = $this->profile->getAvatarUrl();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update()
    {
        $profile = $this->user->profile;
        $avatar = null;
        if ($this->avatar) {
            $this->validate();
            Log::debug('avatar validado.');
            $fileName = Str::slug($this->user->name, '-') . '.' . $this->avatar->extension();
            $avatar = $this->avatar->storeAs('avatars', $fileName, 'public');
        }

        if ($this->avatar) {
            $validatedData['avatar'] = $avatar;
        }
        $validatedData['birthdate'] = $this->birthdate ?: null;
        $validatedData['country_id'] = $this->countryId ?: null;
        $validatedData['location'] = $this->location ?: null;
        $validatedData['notifications'] = $this->notifications;
        $profile->fill($validatedData);

        if ($profile->isDirty()) {
            if ($profile->update()) {
                Log::debug('update!!.');
                $this->emit('update');
            } else {
                Log::debug('update error.');
                $this->emit('updateError');
            }
        } else {
            Log::debug('sin cambios.');
            $this->emit('noDirty');
        }

        if ($this->avatar) {
            $this->profile = $profile;
            $this->initializeAvatar();
            Log::debug('avatar inicializado y reload');

            return redirect()->route('profile');
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
        $this->initializeAvatar();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('account.profile.general-data-form');
    }

}
