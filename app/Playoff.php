<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playoff extends Model
{
	protected $fillable = ['group_id', 'predefined_rounds', 'num_rounds'];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
