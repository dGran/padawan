<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerPack extends Model
{
    protected $table = 'players_packs';
    public $timestamps = false;

    public function season()
    {
        return $this->belongsTo('App\Season');
    }
}
