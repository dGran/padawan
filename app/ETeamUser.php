<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETeamUser extends Model
{
    protected $table = "eteams_users";
    protected $fillable = ['eteam_id', 'user_id', 'position_id', 'admin', 'contract_from', 'contract_to'];

    public function eteam()
    {
        return $this->belongsTo('App\ETeam', 'eteam_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function position()
    {
        return $this->belongsTo('App\GamePosition', 'position_id');
    }

    public function isAdmin()
    {
        return $this->admin;
    }
}
