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

    public function scopeSeason($query, $season)
    {
        if ($season > 0) {
            $query->where("season_id", "=", $season);
        }
    }

    public function name()
    {
        if ($this->season->tournament->participant_type == "individual") {
            return $this->user->name;
        } else {
            return $this->eteam->name;
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
