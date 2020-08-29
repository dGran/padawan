<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceVideo extends Model
{
	protected $table = 'races_videos';

	protected $fillable = ['race_id', 'title', 'provider', 'video_id', 'description'];

    public function race()
    {
        return $this->belongsTo('App\Race');
    }
}
