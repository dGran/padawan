<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Http\Traits\DatesTranslator;

class Race extends Model
{
	protected $fillable = ['racing_id', 'circuit_id', 'name', 'short_name', 'date', 'laps', 'pre_qualifying', 'qualifying', 'slug'];
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

    public function videos()
    {
        return $this->hasMany('App\RaceVideo', 'race_id', 'id');
    }

    public function getDateAttribute($date)
    {
        return new \Date($date);
    }

    public function finished()
    {
        $result = RaceResult::where('race_id', '=', $this->id)->where('position', '=', 1)->count();
        if ($result > 0) {
            return true;
        }
        return false;
    }

    public function has_media()
    {
        // if (is_null($this->twitch_video_id) && is_null($this->youtube_video_id)) {
        //     return false;
        // }
        return true;
    }

    public function fastest_lap()
    {
        $fastest_lap = RaceResult::where('race_id', '=', $this->id)->where('fastest_lap', '=', 1)->first();
        return $fastest_lap->group_participant->participant;
    }

    public function pole()
    {
        $pole = RaceResult::where('race_id', '=', $this->id)->where('pole', '=', 1)->first();
        return $pole->group_participant->participant;
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

    public function position_participant($id)
    {
        $position = RaceResult::where('race_id', $this->id)->where('group_participant_id', $id)->first();
        if ($position) {
            if ($position->position == 0) {
                return null;
            }
            return $position->position;
        }
        return null;
    }

    public function short_name()
    {
        if (!$this->short_name) {
            $race = str_replace(' ', '', $this->name);
            return substr($race, 0, 3);
        }
        return $this->short_name;
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }

}
