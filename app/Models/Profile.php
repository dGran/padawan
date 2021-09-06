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
}
