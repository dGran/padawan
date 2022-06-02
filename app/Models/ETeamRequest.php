<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamRequest extends Model
{
    use HasFactory;

    protected $table = 'eteams_requests';

    protected $fillable = [
        'eteam_id', 'user_id', 'state', 'contract_from', 'contract_to', 'message'
    ];

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
