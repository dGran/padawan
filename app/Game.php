<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	protected $fillable = ['platform_id', 'name', 'img', 'banner', 'mode_league', 'mode_playoffs', 'mode_races', 'rosters', 'positions', 'circuits', 'slug'];
    public $timestamps = false;

    public function platform()
    {
        return $this->belongsTo('App\Platform');
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function scopePlatform($query, $platform)
    {
        if (!$platform == 0) {
            $query->where("platform_id", "=", $platform);
        }
    }

    public function scopeOnlyModeLeague($query, $value)
    {
        if ($value) {
            return $query->where('mode_league', $value);
        } else {
            return $query;
        }
    }

    public function scopeOnlyModePlayoffs($query, $value)
    {
        if ($value) {
            return $query->where('mode_playoffs', $value);
        } else {
            return $query;
        }
    }

    public function scopeOnlyModeRaces($query, $value)
    {
        if ($value) {
            return $query->where('mode_races', $value);
        } else {
            return $query;
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

    public function banner()
    {
        $default = asset('img/games/default_banner.png');
        $custom = asset('img/games/' . $this->banner);

        if ($this->banner) {
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
