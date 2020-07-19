<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    public $timestamps = false;
    protected $fillable = ['competition_id', 'name', 'mode', 'num_participants', 'order', 'active', 'slug'];

    public function competition()
    {
        return $this->belongsTo('App\Competition');
    }

    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function scopeCompetitionId($query, $competition)
    {
        if ($competition > 0) {
            $query->where("competition_id", "=", $competition);
        }
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function scopeMode($query, $mode)
    {
        if (!$mode == 0) {
            $query->where("mode", "=", $mode);
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }

    public function mode_name()
    {
        switch ($this->mode) {
            case 'league':
                return "Liga";
                break;
            case 'playoff':
                return "Playoffs";
                break;
            case 'race':
                return "Carreras";
                break;
        }
    }

    public function preview_phase()
    {
        if ($this->order > 1) {
            $phase = Phase::where('competition_id', '=', $this->competition_id)->where('order', '=', $this->order -1)->first();
        } else {
            return false;
        }
    }

    public function max_participants()
    {
        $preview = $this->preview_phase();
        if ($preview) {
            return $preview->num_participants;
        }
        if ($this->competition->season->num_participants > 0) {
            return $this->competition->season->num_participants;
        }
        return null;
    }

    public function max_participants_new_group()
    {
        $counter = 0;
        foreach ($this->groups as $group) {
            $counter += $group->num_participants;
        }
        return $this->num_participants - $counter;
    }

    public function current_participants()
    {
        return Group::where('phase_id', $this->id)->sum('num_participants');
    }

    public function fullParticipants()
    {
        if ($this->num_participants > $this->current_participants()) {
            return false;
        } else {
            return true;
        }
    }
}
