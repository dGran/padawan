<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETeamRequest extends Model
{
    protected $table = "eteams_requests";
    protected $fillable = ['eteam_id', 'user_id', 'send_by', 'state', 'contract_from', 'contract_to', 'message'];

    public function eteam()
    {
        return $this->belongsTo('App\ETeam');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
