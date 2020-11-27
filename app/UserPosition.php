<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    protected $table = 'users_positions';

    public $timestamps = false;
    protected $fillable = ['user_id', 'game_id', 'position_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function position()
    {
        return $this->belongsTo('App\GamePosition', 'position_id');
    }
}
