<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupParticipant extends Model
{
    protected $table = 'groups_participants';

    public $timestamps = false;
    protected $fillable = ['group_id', 'participant_id'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    public function scopeGroupId($query, $group)
    {
        if ($group > 0) {
            $query->where("group_id", "=", $group);
        }
    }

    public function scopeParticipantId($query, $participant)
    {
        if ($participant > 0) {
            $query->where("participant_id", "=", $participant);
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
        if ($this->participant) {
            $presenter = $this->participant->presenter();
        } else {
            if ($this->group->phase->competition->season->tournament->use_teams) {
                $presenter['defined'] = false;
                $presenter['name'] = 'No definido';
                $presenter['subname'] = 'No definido';
                $presenter['img'] = asset('img/teams/default.png');
            } else {
                if ($this->group->phase->competition->season->tournament->participant_type == "individual") {
                    $presenter['defined'] = false;
                    $presenter['name'] = 'No definido';
                    $presenter['subname'] = null;
                    $presenter['img'] = asset('img/avatars/default.png');
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

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
