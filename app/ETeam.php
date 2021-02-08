<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class ETeam extends Model
{
    protected $table = "eteams";
    protected $fillable = ['game_id', 'name', 'img', 'location', 'short_name', 'owner_id', 'slug'];

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function users()
    {
        return $this->hasMany('App\ETeamUser', 'eteam_id');
    }

    public function requests()
    {
        return $this->hasMany('App\ETeamRequest', 'eteam_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('eteams.name', 'LIKE', "%{$value}%")
                                ->orWhere('eteams.location', 'LIKE', "%{$value}%")
                                ->orWhere('users.name', 'LIKE', "%{$value}%")
                                ->orWhere('eteams.short_name', 'LIKE', "%{$value}%");
                            });
        }
        // if (trim($name) !="") {
        //     $query->where("name", "LIKE", "%$name%");
        // }
    }

    public function scopeGame($query, $game)
    {
        if ($game !== "all") {
            $query->where("game_id", "=", $game);
        }
    }

    public function img()
    {
        $default = asset('img/eteams/default.png');
        $custom = asset('img/eteams/' . $this->img);

        if ($this->img) {
            if ($this->check_img($custom)) {
                return $custom;
            }
        }
		return $default;
    }

    protected function check_img($image) {
        if (!$image) return FALSE;
        // $headers = get_headers($image);
        // return stripos($headers[0], "200 OK") ? TRUE : FALSE;
        return true;
    }

    public function getCreatedAtDate()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("D MMMM YYYY");
    }

    public function getCreatedAtTime()
    {
        $date = Carbon::parse($this->created_at)->locale(app()->getLocale());
        return $date->isoFormat("kk[:]mm");
    }

    public function userIsMember() {
        $member = ETeamUser::
            where('eteam_id', $this->id)
            ->where('user_id', Auth::id())
            ->count();
        if ($member) {
            return true;
        }
        return false;
    }

    public function userRequest() {
        $request = ETeamRequest::
            where('eteam_id', $this->id)
            ->where('user_id', Auth::id())
            ->where('state', 'pending')
            ->count();
        if ($request) {
            return true;
        }
        return false;
    }

    public function userIsAdmin() {
        $admin = ETeamUser::
            where('eteam_id', $this->id)
            ->where('user_id', Auth::id())
            ->where('admin', 1)
            ->count();
        if ($admin) {
            return true;
        }
        return false;
    }
}
