<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionStat extends Model
{
    public $timestamps = false;
    protected $table = 'competitions_stats';

    public function competition()
    {
        return $this->belongsTo('App\Competition');
    }

    public function match()
    {
        return $this->belongsTo('App\Match');
    }

    public function player()
    {
        return $this->hasMany('App\Player');
    }

    public function eplayer()
    {
        return $this->hasMany('App\EPlayer');
    }
}
