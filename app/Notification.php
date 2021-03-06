<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'eteam_request_id', 'match_id', 'text', 'read'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function eteam_request()
    {
        return $this->belongsTo('App\ETeamRequest');
    }
}
