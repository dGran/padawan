<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceResult extends Model
{
	protected $table = 'races_results';

	protected $fillable = ['race_id', 'group_participant_id', 'user_id', 'eteam_id', 'type', 'position', 'time', 'fastest_lap', 'sanction'];

    public function race()
    {
        return $this->belongsTo('App\Race');
    }

    public function group_participant()
    {
        return $this->belongsTo('App\GroupParticipant');
    }
}
