<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	protected $fillable = ['game_id', 'name', 'img', 'league_name', 'slug'];
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

    public function img()
    {
        $default = asset('img/teams/default.png');
        $custom = asset('img/teams/' . $this->img);

        if ($this->img) {
            if ($this->check_img($custom)) {
                return $custom;
            }
        }
		return $default;
    }

    protected function check_img($image) {
        if (!$image) return FALSE;
        $headers = get_headers($image);
        return stripos($headers[0], "200 OK") ? TRUE : FALSE;
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
