<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clash extends Model
{
    protected $table = 'playoffs_rounds_clashes';
    public $timestamps = false;

    public function round()
    {
        return $this->belongsTo('App\PlayoffRound', 'round_id');
    }

    public function local_participant()
    {
    	return $this->belongsTo('App\GroupParticipant', 'local_id');
    }

    public function visitor_participant()
    {
    	return $this->belongsTo('App\GroupParticipant', 'visitor_id');
    }
}
