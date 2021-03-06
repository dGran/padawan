<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
	protected $fillable = ['season_id', 'user_id', 'eteam_id', 'team_id'];
    public $timestamps = false;

    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function eteam()
    {
        return $this->belongsTo('App\ETeam');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function scopeSeasonId($query, $season)
    {
        if ($season > 0) {
            $query->where("season_id", "=", $season);
        }
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("teams.name", "LIKE", "%$name%");
            $query->orWhere("users.name", "LIKE", "%$name%");
            $query->orWhere("eteams.name", "LIKE", "%$name%");
        }
    }

    public function presenter()
    {
        $presenter = [];
        if ($this->season->tournament->use_teams) {
            if ($this->team) {
                $presenter['defined'] = true;
                $presenter['name'] = $this->team->name;
                $presenter['img'] = $this->team->img();
                if ($this->season->tournament->participant_type == "individual") {
                    $presenter['subname'] = $this->user ? $this->user->name : 'no definido';
                } else {
                    $presenter['subname'] = $this->eteam ? $this->eteam->name : 'no definido';
                }
            } else {
                $presenter['defined'] = false;
                $presenter['name'] = 'No definido';
                $presenter['subname'] = 'No definido';
                $presenter['img'] = asset('img/teams/default.png');
            }
        } else {
            if ($this->season->tournament->participant_type == "individual") {
                if ($this->user) {
                    $presenter['defined'] = true;
                    $presenter['name'] = $this->user->name;
                    $presenter['subname'] = null;
                    $presenter['img'] = $this->user->profile->avatar();
                } else {
                    $presenter['defined'] = false;
                    $presenter['name'] = 'No definido';
                    $presenter['subname'] = null;
                    $presenter['img'] = asset('img/avatars/default.png');
                }
            } else {
                if ($this->eteam) {
                    $presenter['defined'] = true;
                    $presenter['name'] = $this->eteam->name;
                    $presenter['subname'] = null;
                    $presenter['img'] = $this->eteam->img();
                } else {
                    $presenter['defined'] = false;
                    $presenter['name'] = 'No definido';
                    $presenter['subname'] = null;
                    $presenter['img'] = asset('img/eteams/default.png');
                }
            }
        }
        return $presenter;
    }

    public function is_free()
    {
        if ($this->season->tournament->participant_type == "individual") {
            if (!$this->user) {
                return true;
            }
        } else {
            if (!$this->eteam) {
                return true;
            }
        }
        return false;
    }

    public function name_without_team()
    {
        if ($this->season->tournament->participant_type == "individual")
        {
            if ($this->user) {
                return $this->user->name;
            }
            return "No definido";
        } else {
            if ($this->eteam) {
                return $this->eteam->name;
            }
            return "No definido";
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
