<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	protected $fillable = ['players_databases_id', 'name', 'img', 'team_name', 'nation_name', 'league_name', 'position_id', 'height', 'age', 'foot', 'overall_rating', 'game_id'];
    public $timestamps = false;

    public function player_database()
    {
        return $this->belongsTo('App\PlayerDatabase', 'players_databases_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo('App\GamePosition');
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function scopePlayerDatabase($query, $playerDatabase)
    {
        if ($playerDatabase > 0) {
            $query->where("players_databases_id", "=", $playerDatabase);
        }
    }

    public function scopeTeam($query, $name)
    {
        if (trim($name) !="") {
            $query->where("team_name", "LIKE", "%$name%");
        }
    }

    public function scopeNation($query, $name)
    {
        if (trim($name) !="") {
            $query->where("nation_name", "LIKE", "%$name%");
        }
    }

    public function scopeLeague($query, $name)
    {
        if (trim($name) !="") {
            $query->where("league_name", "LIKE", "%$name%");
        }
    }

    public function scopePosition($query, $position)
    {
        if ($position > 0) {
            $query->where("position_id", "=", $position);
        }
    }

    // pending scopes: height, age, foot, overall_rating
    // logic with between


    public function img()
    {
        $default = asset('img/players/default.png');
        $custom = asset('img/players/' . $this->img);

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
