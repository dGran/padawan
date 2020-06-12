<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
	protected $fillable = ['name', 'img'];

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function img()
    {
        $default = asset('img/platforms/default.png');
        $custom = asset('img/platforms/' . $this->img);

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
