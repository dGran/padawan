<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'avatar',
        'birthdate',
        'location',
        'whatsapp',
        'facebook',
        'instagram',
        'twitter',
        'twitch',
        'discord',
        'xbox_id',
        'ps_id',
        'steam_id',
        'notifications',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }

    public function getAvatarUrl(): string
    {
        if (!$this->avatar) {
            return "https://eu.ui-avatars.com/api/?name=" . $this->user->name;
        }
        return $this->avatar;
    }

    public function getCountryName(): string
    {
        if ($this->country_id) {
            return $this->country->name;
        }
        return "N/D";
    }

    public function getFlag(): string
    {
        if ($this->country_id) {
            return $this->country->getFlag24();
        }
        return asset('img/flags/no_flag.png');
    }

    public function getFacebookUrl(): ?string
    {
        if ($this->facebook) {
            return "https://www.facebook.com/" . $this->facebook;
        }
        return null;
    }

    public function getTwitterUrl(): ?string
    {
        if ($this->twitter) {
            return "https://twitter.com/" . $this->twitter;
        }
        return null;
    }

    public function getInstagramUrl(): ?string
    {
        if ($this->instagram) {
            return "https://www.instagram.com/" . $this->instagram;
        }
        return null;
    }

    public function getTwitchUrl(): ?string
    {
        if ($this->twitch) {
            return "https://www.twitch.tv/" . $this->twitch;
        }
        return null;
    }

}
