<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'origin_id',
        'steam_id',
        'notifications',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getAvatarUrl()
    {
        if (!$this->avatar) {
            return "https://eu.ui-avatars.com/api/?name=" . $this->user->name;
        }
        return $this->avatar;
    }

    public function getFacebookUrl()
    {
        if ($this->facebook) {
            return "https://www.facebook.com/" . $this->facebook;
        }
        return false;
    }

    public function getTwitterUrl()
    {
        if ($this->twitter) {
            return "https://twitter.com/" . $this->twitter;
        }
        return false;
    }

    public function getInstagramUrl()
    {
        if ($this->instagram) {
            return "https://www.instagram.com/" . $this->instagram;
        }
        return false;
    }

    public function getTwitchUrl()
    {
        if ($this->twitch) {
            return "https://www.twitch.tv/" . $this->twitch;
        }
        return false;
    }
}