<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayoffRound extends Model
{
    protected $table = 'playoffs_rounds';
    public $timestamps = false;

    public function playoff()
    {
        return $this->belongsTo('App\Playoff');
    }

    public function participants()
    {
    	return $this->hasMany('App\PlayoffRoundParticipant', 'id', 'round_id');
    }

    public function clashes()
    {
    	return $this->hasMany('App\Clash', 'clash_id');
    }
}
