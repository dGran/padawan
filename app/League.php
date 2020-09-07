<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
	protected $fillable = ['group_id', 'allow_draws', 'win_points', 'draw_points', 'lose_points', 'play_amount', 'win_amount', 'draw_amount', 'lose_amount'];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function days()
    {
        return $this->hasMany('App\LeagueDay', 'league_id');
    }

    public function tablezones()
    {
        return $this->hasMany('App\LeagueTablezone', 'league_id');
    }

    public function played_matches()
    {
        $played_matches = 0;
        if ($this->days->count() > 0) {
            foreach ($this->days as $day) {
                if ($day->matches->count() > 0) {
                    foreach ($day->matches as $match) {
                        if (!is_null($match->local_score) && !is_null($match->visitor_score)) {
                            $played_matches++;
                        }
                    }
                }
            }
        }
        return $played_matches;
    }

}
