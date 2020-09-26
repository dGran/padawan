<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public $timestamps = false;

    public function competition()
    {
        return $this->belongsTo('App\Competition', 'competition_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }

    public function day()
    {
    	return $this->belongsTo('App\LeagueDay', 'day_id');
    }

    public function clash()
    {
    	return $this->belongsTo('App\PlayoffRoundClash', 'clash_id');
    }

    public function local_participant()
    {
    	return $this->belongsTo('App\GroupParticipant', 'local_id');
    }

    public function local_user_participant()
    {
    	return $this->belongsTo('App\User', 'local_user_id');
    }

    public function local_eteam_participant()
    {
    	return $this->belongsTo('App\Eteam', 'local_eteam_id');
    }

    public function visitor_participant()
    {
    	return $this->belongsTo('App\GroupParticipant', 'visitor_id');
    }

    public function visitor_user_participant()
    {
    	return $this->belongsTo('App\User', 'visitor_user_id');
    }

    public function visitor_eteam_participant()
    {
    	return $this->belongsTo('App\Eteam', 'visitor_eteam_id');
    }

    public function sanctioned_participant()
    {
    	return $this->belongsTo('App\GroupParticipant', 'sanctioned_id');
    }

    public function played()
    {
        if (is_null($this->local_score) && is_null($this->visitor_score)) {
            return false;
        }
        return true;
    }

    public function result()
    {
        return $this->local_score . '-' . $this->visitor_score;
    }

    public function name()
    {
        return $this->local_participant->presenter()['name'] . ' vs ' . $this->visitor_participant->presenter()['name'];
    }

    public function day_name()
    {
        return "Jornada " . $this->day->order;
    }
}
