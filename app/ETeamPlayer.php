<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETeamPlayer extends Model
{
    protected $table = "eteams_players";

    public function eteam()
    {
        return $this->belongsTo('App\ETeam', 'eteam_id');
    }

    public function eplayer()
    {
    	return $this->belongsTo('App\EPlayer', 'eplayer_id');
    }

}
