<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Racing extends Model
{
	protected $fillable = ['group_id', 'fastest_lap', 'score_fastest_lap', 'pre_qualifying', 'qualifying', 'score_pole', 'times', 'show_circuit_flags'];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function scores()
    {
        return $this->hasMany('App\RacingScore', 'racing_id', 'id');
    }

    public function races()
    {
        return $this->hasMany('App\Race', 'racing_id', 'id');
    }

    public function nextRace()
    {
        foreach ($this->races->sortBy('date') as $race) {
            if (!$race->finished() && \Carbon\Carbon::parse($race->date) > \Carbon\Carbon::now()) {
                return $race;
            }
        }
        return false;
    }

    public function nextRaceDate()
    {
        if ($this->nextRace()) {
            return \Carbon\Carbon::parse($this->nextRace()->date);
        }
        return false;
    }

    public function nextRaceDateTimestamp()
    {
        if ($this->nextRace()) {
            return \Carbon\Carbon::parse($this->nextRace()->date)->timestamp;
        }
        return false;
    }

    public function generate_table()
    {
        $group_participants = GroupParticipant::where('group_id', '=', $this->group->id)->get();
        $table_participants = collect();

        foreach ($group_participants as $key => $participant) {
            $race_results = RaceResult::where('group_participant_id', '=', $participant->id)->get();
            $pts = 0;
            foreach ($race_results as $result) {
                $score = RacingScore::where('racing_id', '=', $this->id)->where('position', '=', $result->position)->first();
                if ($score) {
                    $pts += $score->score;
                }
            }
            $table_participants->push([
                'participant' => $participant,
                'pts' => $pts,
            ]);
        }
        $table_participants = $table_participants->sortByDesc('pts')->values();

        return $table_participants;
    }
}
