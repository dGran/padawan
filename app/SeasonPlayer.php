<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonPlayer extends Model
{
    protected $table = 'seasons_players';
    public $timestamps = false;

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function player()
    {
        return $this->belongsTo('App\Player');
    }
}
