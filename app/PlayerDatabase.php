<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerDatabase extends Model
{
    protected $table = 'players_databases';

	protected $fillable = ['game_id', 'name', 'slug'];
    public $timestamps = false;

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function scopeGame($query, $game)
    {
        if ($game > 0) {
            $query->where("game_id", "=", $game);
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
