<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Racing extends Model
{
	protected $fillable = ['group_id', 'num_races', 'fastest_lap'];
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
