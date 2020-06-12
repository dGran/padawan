<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	protected $fillable = ['platform_id', 'name', 'img', 'banner', 'mode_league', 'mode_playoffs', 'mode_races', 'rosters'];
    public $timestamps = false;

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function img()
    {
        $default = asset('img/games/default.png');
        $custom = asset('img/games/' . $this->img);

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
