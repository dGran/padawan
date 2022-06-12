<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamUser extends Model
{
    use HasFactory;

    protected $table = 'eteams_users';

    protected $fillable = [
        'eteam_id', 'user_id', 'owner', 'captain', 'active', 'name', 'img', 'game_position_id', 'contract_from', 'contract_to'
    ];

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getName()
    {
        return $this->name ? $this->name : $this->user->name;
    }

    public function getImgUrl()
    {
        if (!$this->img) {
            if ($this->isRacing()) {
                return "https://toksport.com/wp-content/uploads/2020/07/race-driver-empty-compressor.png";
            } else {
                return "https://images.vexels.com/media/users/3/132248/isolated/preview/e3825a50d945f17953fb51192ed4047d-silueta-de-jugador-de-futbol.png";
            }
        }
        return $this->img;
    }

    public function isRacing()
    {
        return $this->eteam->game->racing ? true : false;
    }
}
