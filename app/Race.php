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

    // public function getDateAttribute()
    // {
    //     dd($this->date);
    //     return \Carbon\Carbon::parse($this->date)->format('Y-m-d\TH:i');
    // }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }

}
