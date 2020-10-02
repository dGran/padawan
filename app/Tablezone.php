<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tablezone extends Model
{
	protected $fillable = ['name', 'img'];
    public $timestamps = false;

    public function img()
    {
        $default = asset('img/tablezones/default.png');
        $custom = asset('img/tablezones/' . $this->img);

        if ($this->img) {
            // if ($this->check_img($custom)) {
                return $custom;
            // }
        }
		return $default;
    }

    protected function check_img($image) {
        if (!$image) return FALSE;
        $headers = get_headers($image);
        return stripos($headers[0], "200 OK") ? TRUE : FALSE;
    }
}


