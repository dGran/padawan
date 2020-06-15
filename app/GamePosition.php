<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamePosition extends Model
{
    protected $table = 'games_positions';

	protected $fillable = ['game_id', 'name', 'category', 'font_icon', 'order'];
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

    public function scopeCategory($query, $category)
    {
        if (trim($category) !="") {
            $query->where("category", "LIKE", "%$category%");
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
