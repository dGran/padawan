<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile() {
        return $this->hasOne('App\Models\Profile');
    }

    public function getAge()
    {
        if ($this->profile && $this->profile->birthdate) {
            return Carbon::parse($this->profile->birthdate)->age;
        }
    }

    public function getAvatarUrl()
    {
        if (!$this->profile) {
            return "https://eu.ui-avatars.com/api/?name=" . $this->name;
        }
        return $this->profile->getAvatarUrl();
    }
}
