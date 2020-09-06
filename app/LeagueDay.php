<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueDay extends Model
{
	protected $table = "leagues_days";
	protected $fillable = ['league_id', 'order', 'date_limit', 'active'];
    public $timestamps = false;

    public function league()
    {
        return $this->belongsTo('App\League');
    }

}