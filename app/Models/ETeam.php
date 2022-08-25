<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ETeam extends Model
{
    use HasFactory;

    protected $table = 'eteams';

    protected $fillable = [
        'game_id', 'name', 'short_name', 'logo', 'banner', 'country_id', 'location', 'member_requests', 'active', 'open', 'presentation', 'presentation_video', 'website', 'whatsapp', 'facebook', 'instagram', 'twitter', 'twitch', 'youtube', 'slug'
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

    public function logs()
    {
        return $this->hasMany('App\Models\ETeamLog', 'eteam_id', 'id');
    }

    public function scopeSearch($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                $q->where('eteams.name', 'LIKE', "%{$value}%")
                    ->orWhere('eteams.location', 'LIKE', "%{$value}%")
                    ->orWhere('games.name', 'LIKE', "%{$value}%");
            });
        }
    }

    public function scopeGame($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                $q->where('games.name', 'LIKE', "%{$value}%");
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
        return Storage::url($this->logo);
    }

    public function getBanner()
    {
        if (!$this->banner) {
            return $this->game->getBanner();
        }
        return Storage::url($this->banner);
    }

    public function getCreatedAtFormated()
    {
        return Carbon::parse($this->created_at)->formatLocalized("%d %b '%y");
    }

    public function getCaptains()
    {
        return ETeamUser::where('eteam_id', $this->id)
            ->where('active', 1)
            ->where(function($q) {
                $q->where('owner', 1)
                ->orWhere('captain', 1);
            })
            ->get();
    }

    public function getMembers(?array $excludeIds)
    {
        $members = ETeamUser::where('eteam_id', $this->id)
            ->where('active', 1);

        if (!empty($excludeIds)) {
            $members = $members->whereNotIn('user_id', $excludeIds);
        }

        return $members->get();
    }
}
