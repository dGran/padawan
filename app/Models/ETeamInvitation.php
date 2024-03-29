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

    public const STATE_PENDING = 'pending';

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }

    public function captain()
    {
        return $this->belongsTo('App\Models\ETeamUser', 'captain_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
