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
}
