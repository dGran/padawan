<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\DatesTranslator;

class Tournament extends Model
{
	protected $fillable = ['game_id', 'current_season_id', 'name', 'img', 'banner', 'participant_type', 'use_teams', 'use_rosters', 'use_economy', 'use_salaries', 'use_transfers', 'use_clauses', 'use_free_agents', 'rules', 'slug'];

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function current_season()
    {
        return $this->belongsTo('App\Season', 'current_season_id');
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

    public function currentSeason()
    {
        if (!is_null($this->current_season_id)) {
            return $this->current_season;
        }
        if ($this->seasons->count() > 0) {
            return $this->seasons->first();
        }
        return null;
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

    public function getLogo()
    {
        if ($this->img) {
            return $this->img();
        } else {
            return $this->game->img();
        }
    }

    public function banner()
    {
        $default = asset('img/tournaments/default_banner.png');
        $custom = asset('img/tournaments/' . $this->banner);

        if ($this->banner) {
            if ($this->check_img($custom)) {
                return $custom;
            }
        }
        return $default;
    }

    public function getBanner()
    {
        if ($this->banner) {
            return $this->banner();
        } else {
            return $this->game->banner();
        }
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

    public function has_sponsors()
    {
        // apply logic...
        // defaults return true

        return false;
    }

    public function is_one_scpg()
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

    public function one_scpg()
    {
        if ($this->is_one_scpg()) {
            $data['season'] = $this->seasons->first()->slug;
            $data['competition'] = $this->seasons->first()->competitions->first()->slug;
            $data['phase'] = $this->seasons->first()->competitions->first()->phases->first()->slug;
            $data['group'] = $this->seasons->first()->competitions->first()->phases->first()->groups->first()->slug;
            return $data;
        }
    }

    public function one_scpg_model()
    {
        if ($this->is_one_scpg()) {
            $data['season'] = $this->seasons->first();
            $data['competition'] = $this->seasons->first()->competitions->first();
            $data['phase'] = $this->seasons->first()->competitions->first()->phases->first();
            $data['group'] = $this->seasons->first()->competitions->first()->phases->first()->groups->first();
            return $data;
        }
    }

    public function one_scpg_mode()
    {
        if ($this->is_one_scpg()) {
            return $this->seasons->first()->competitions->first()->phases->first()->mode;
        }
    }
}
