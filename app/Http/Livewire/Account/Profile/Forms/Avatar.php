<?php

declare(strict_types=1);

namespace App\Http\Livewire\Account\Profile\Forms;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{
    use WithFileUploads;

    public $user, $profile, $avatar, $avatarPreview;

    protected $rules = [
        'avatar' => 'mimes:jpeg,png,jpg,gif,svg|max:1024|nullable'
    ];

    protected $messages = [
        'avatar.mimes' => 'El avatar debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
        'avatar.max' => 'El tamaño del avatar no puede ser mayor a 1024 bytes',
        'avatar-nullable' => 'Debes de seleccionar una imagen'
    ];

    public function initializeAvatar(): void {
        $this->avatar = null;
        $this->avatarPreview = $this->profile->getAvatarUrl();
    }

    public function remove()
    {
        $this->initializeAvatar();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update()
    {
        if ($this->avatar) {
            $this->validate();

            $fileName = Str::slug($this->user->name, '-') . '.' . $this->avatar->extension();
            $avatar = $this->avatar->storeAs('avatars', $fileName, 'public');

            $this->profile->avatar = $avatar;

            if ($this->profile->update()) {
                $this->initializeAvatar();

                return redirect()->route('profile');
            }
        }
    }

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->profile = $user->profile;
        $this->initializeAvatar();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('account.profile.avatar-form');
    }
}
