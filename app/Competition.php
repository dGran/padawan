<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    public $timestamps = false;
    protected $fillable = ['season_id', 'name', 'img', 'slug'];

    public function season()
    {
        return $this->belongsTo('App\Season');
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
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function img()
    {
        $default = asset('img/competitions/default.png');
        $custom = asset('img/competitions/' . $this->img);

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
