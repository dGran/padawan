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
        $result = RaceResult::where('race_id', '=', $this->id)->where('type', '=', 'race')->where('position', '=', 1)->count();
        if ($result > 0) {
            return true;
        }
        return false;
    }

    public function qualys_finished()
    {
        $result = RaceResult::where('race_id', '=', $this->id)->where('type', 'LIKE', '%'.'qualy'.'%')->where('position', '=', 1)->count();
        if ($result > 0) {
            return true;
        }
        return false;
    }

    public function has_media()
    {
        if ($this->videos->count() > 0) {
            return true;
        }
        return false;
    }

    public function fastest_lap()
    {
        $fastest_lap = RaceResult::where('race_id', '=', $this->id)->whereNotNull('fastest_lap')->orderBy('fastest_lap', 'asc')->first();
        return $fastest_lap;
    }

    public function pole()
    {
        $pole = RaceResult::where('race_id', '=', $this->id)->whereNotNull('time')->where('type', '=', 'qualy')->orderBy('position', 'asc')->first();
        return $pole;
    }

    public function score_participant($id)
    {
        $position = RaceResult::where('race_id', $this->id)->where('group_participant_id', $id)->where('type', '=', 'race')->first();
        if ($position) {
            if ($position->position == 0) {
                return '-';
            }
            $score = RacingScore::where('racing_id', '=', $this->racing->id)->where('position', '=', $position->position)->first();
            if ($score) {
                $score = $score->score - $position->sanction;
                if ($this->racing->fastest_lap) {
                    if ($this->fastest_lap() && $this->fastest_lap()->group_participant->id == $position->group_participant->id) {
                        $score += $this->racing->score_fastest_lap;
                    }
                }
                if ($this->racing->qualifying) {
                    if ($this->pole() && $this->pole()->group_participant->id == $position->group_participant->id) {
                        $score += $this->racing->score_pole;
                    }
                }
                return $score;
            }
        }
        return '-';
    }

    public function position_participant($id)
    {
        $position = RaceResult::where('race_id', $this->id)->where('group_participant_id', $id)->where('type', '=', 'race')->first();
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
