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

    public function scopeTeam($query, $team_name)
    {
        if (trim($team_name) !="") {
            $query->where("team_name", "LIKE", "%$team_name%");
        }
    }

    public function scopeNation($query, $nation_name)
    {
        if (trim($nation_name) !="") {
            $query->where("nation_name", "LIKE", "%$nation_name%");
        }
    }

    public function scopeLeague($query, $league_name)
    {
        if (trim($league_name) !="") {
            $query->where("league_name", "LIKE", "%$league_name%");
        }
    }

    public function scopePosition($query, $position)
    {
        if ($position > 0) {
            $query->where("position_id", "=", $position);
        }
    }

    public function scopeOverallRange($query, $from, $to)
    {
        if ($from && $to) {
            $query->where("overall_rating", ">=", $from)->where("overall_rating", "<=", $to);
        }
    }

    public function scopeAgeRange($query, $from, $to)
    {
        if ($from && $to) {
            $query->where("age", ">=", $from)->where("age", "<=", $to);
        }
    }

    public function scopeHeightRange($query, $from, $to)
    {
        if ($from && $to) {
            $query->where("height", ">=", $from)->where("height", "<=", $to);
        }
    }

    public function scopeGameID($query, $game_id)
    {
        if (trim($game_id) !="") {
            $query->where("game_id", "=", $game_id);
        }
    }

    public function scopeFoot($query, $foot)
    {
        if (!is_null($foot)) {
            $query->where("foot", "=", $foot);
        }
    }

    // pending scopes: foot, game_id


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
