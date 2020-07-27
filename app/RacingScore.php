<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RacingScore extends Model
{
	protected $table = 'racings_scores';

	protected $fillable = ['racing_id', 'position', 'score'];
    public $timestamps = false;

    public function racing()
    {
        return $this->belongsTo('App\Racing');
    }
}
