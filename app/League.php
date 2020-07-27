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

}
