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

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
