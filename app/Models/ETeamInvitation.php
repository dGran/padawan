<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamInvitation extends Model
{
    use HasFactory;

    protected $table = 'eteams_invitations';

    protected $fillable = [
        'eteam_id', 'captain_id', 'user_id', 'state', 'contract_from', 'contract_to', 'message'
    ];

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }
}
