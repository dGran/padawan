<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    protected $fillable = ['phase_id', 'name', 'num_participants', 'active', 'slug'];

    public function phase()
    {
        return $this->belongsTo('App\Phase');
    }

    public function scopePhaseId($query, $phase)
    {
        if ($phase > 0) {
            $query->where("phase_id", "=", $phase);
        }
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }

    public function max_participants()
    {
    	$phase = $this->phase;
    	$counter = 0;
    	foreach ($phase->groups as $group) {
    		$counter += $group->num_participants;
    	}
    	return ($phase->num_participants + $this->num_participants) - $counter;
    }
}
