<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
	protected $fillable = ['racing_id', 'circuit_id', 'name', 'date', 'laps', 'twitch_video_id', 'youtube_video_id', 'slug'];
    public $timestamps = false;

    public function racing()
    {
        return $this->belongsTo('App\Racing');
    }

    public function circuit()
    {
        return $this->hasOne('App\GameCircuit', 'id', 'circuit_id');
    }

    public function results()
    {
        return $this->hasMany('App\RaceResult', 'race_id', 'id');
    }

    public function finished() {
        $result = RaceResult::where('race_id', '=', $this->id)->where('position', '=', 1)->count();
        if ($result > 0) {
            return true;
        }
        return false;
    }

    public function score_participant($id)
    {
        $position = RaceResult::where('race_id', $this->id)->where('group_participant_id', $id)->first();
        if ($position) {
            if ($position->position == 0) {
                return '-';
            }
            $score = RacingScore::where('racing_id', '=', $this->racing->id)->where('position', '=', $position->position)->first();
            if ($score) {
                return $score->score;
            }
        }
        return '-';
    }

    public function short_name()
    {
        $race = str_replace(' ', '', $this->name);
        return substr($race, 0, 3);
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }

}
