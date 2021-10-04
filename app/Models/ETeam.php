<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeam extends Model
{
    use HasFactory;

    protected $table = 'eteams';

    protected $fillable = [
        'game_id', 'name', 'short_name', 'logo', 'country_id', 'location', 'presentation', 'presentation_video', 'website', 'whatsapp', 'facebook', 'instagram', 'twitter', 'twitch', 'youtube', 'slug'
    ];

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id');
    }

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\ETeamUser', 'eteam_id', 'id');
    }

    public function invitations()
    {
        return $this->hasMany('App\Models\ETeamInvitation', 'eteam_id', 'id');
    }

    public function requests()
    {
        return $this->hasMany('App\Models\ETeamRequest', 'eteam_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\ETeamPost', 'eteam_id', 'id');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                $q->where('name', 'LIKE', "%{$value}%")
                    ->orWhere('location', 'LIKE', "%{$value}%");
                });
        }
    }

    public function getCountryName()
    {
        if ($this->country_id) {
            return $this->country->name;
        }
        return "N/D";
    }

    public function getLogo()
    {
        if (!$this->logo) {
            return $this->game->getLogo();
        }
        return $this->logo;
    }

    public function getBanner()
    {
        if (!$this->banner) {
            return $this->game->getBanner();
        }
        return $this->banner;
    }
}
