<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceResult extends Model
{
	protected $table = 'races_results';

	protected $fillable = ['race_id', 'group_participant_id', 'user_id', 'eteam_id', 'position', 'time', 'lastest_lap', 'pre_qualifying', 'qualifying'];

    public function race()
    {
        return $this->belongsTo('App\Race');
    }
}
