<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
	protected $fillable = ['racing_id', 'circuit_id', 'name', 'date', 'laps', 'pre_qualifying', 'qualifying', 'slug'];
    public $timestamps = false;

    public function racing()
    {
        return $this->belongsTo('App\Racing');
    }

    public function circuit()
    {
        return $this->hasOne('App\GameCircuit', 'id', 'circuit_id');
    }

    public function results()
    {
        return $this->hasOne('App\RaceResult', 'race_id', 'id');
    }
}
