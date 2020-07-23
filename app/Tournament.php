<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
	protected $fillable = ['game_id', 'name', 'img', 'participant_type', 'use_teams', 'use_rosters', 'use_economy', 'use_salaries', 'use_transfers', 'use_clauses', 'use_free_agents', 'rules', 'slug'];

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function seasons() {
        return $this->hasMany('App\Season');
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

    public function scopeParticipantType($query, $type)
    {
        if (trim($type) !="") {
            $query->where("participant_type", "=", $type);
        }
    }

    public function scopeMarket($query, $market)
    {
        if ($market) {
            $query->where("use_economy", "=", 1)
                  ->orWhere("use_salaries", "=", 1)
                  ->orWhere("use_transfers", "=", 1)
                  ->orWhere("use_clauses", "=", 1)
                  ->orWhere("use_free_agents", "=", 1);
        }
    }

    public function img()
    {
        $default = asset('img/tournaments/default.png');
        $custom = asset('img/tournaments/' . $this->img);

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

    public function one_scpg()
    {
        if ($this->seasons->count() == 1)
        {
            $season = $this->seasons->first();
            if ($season->competitions->count() == 1)
            {
                $competition = $season->competitions->first();
                if ($competition->phases->count() == 1)
                {
                    $phase = $competition->phases->first();
                    if ($phase->groups->count() == 1)
                    {
                        return true;
                    }
                    return false;
                }
                return false;
            }
            return false;
        }
        return false;
    }
}
