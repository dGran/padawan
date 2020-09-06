<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayoffRoundParticipant extends Model
{
    protected $table = 'playoffs_rounds_participants';
    public $timestamps = false;

    public function round()
    {
        return $this->belongsTo('App\PlayoffRound', 'round_id');
    }

    public function group_participant()
    {
    	return $this->hasMany('App\GroupParticipant', 'participant_id');
    }
}
