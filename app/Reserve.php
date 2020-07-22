<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
	protected $fillable = ['season_id', 'user_id', 'eteam_id'];

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function eteam()
    {
        return $this->belongsTo('App\ETeam');
    }

    public function scopeSeasonId($query, $season)
    {
        if ($season > 0) {
            $query->where("season_id", "=", $season);
        }
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("users.name", "LIKE", "%$name%");
            $query->orWhere("eteams.name", "LIKE", "%$name%");
        }
    }

    public function presenter()
    {
        $presenter = [];
        if ($this->season->tournament->participant_type == "individual") {
            if ($this->user) {
                $presenter['name'] = $this->user->name;
                $presenter['img'] = $this->user->profile->avatar();
            } else {
                $presenter['name'] = 'No definido';
                $presenter['img'] = asset('img/avatars/default.png');
            }
        } else {
            if ($this->eteam) {
                $presenter['name'] = $this->eteam->name;
                $presenter['img'] = $this->eteam->img();
            } else {
                $presenter['name'] = 'No definido';
                $presenter['img'] = asset('img/eteams/default.png');
            }
        }

        return $presenter;
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
