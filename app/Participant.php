<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
	protected $fillable = ['season_id', 'user_id', 'eteam_id', 'team_id', 'reserve', 'clasues_paid', 'clasues_received'];

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

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function scopeSeasonId($query, $season)
    {
        if ($season > 0) {
            $query->where("season_id", "=", $season);
        }
    }

    public function presenter()
    {
        $presenter = [];
        if ($this->season->tournament->use_teams) {
            $presenter['name'] = $this->team->name;
            $presenter['img'] = $this->team->img();
        } else {
            if ($this->season->tournament->participant_type == "individual") {
                $presenter['name'] = $this->user->name;
                $presenter['img'] = $this->user->profile->avatar();
            } else {
                $presenter['name'] = $this->eteam->name;
                $presenter['img'] = $this->eteam->img();
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
