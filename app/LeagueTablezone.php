<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueTablezone extends Model
{
    protected $table = 'leagues_tablezones';

	protected $fillable = ['league_id', 'tablezone_id', 'position'];
    public $timestamps = false;

    public function league()
    {
        return $this->belongsTo('App\League');
    }

    public function tablezone()
    {
        return $this->belongsTo('App\Tablezone', 'tablezone_id');
    }

}
