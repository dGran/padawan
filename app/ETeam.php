<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETeam extends Model
{
    protected $table = "eteams";

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'id', 'owner_id');
    }

    public function img()
    {
        $default = asset('img/eteams/default.png');
        $custom = asset('img/eteams/' . $this->img);

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
}
