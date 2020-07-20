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

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
