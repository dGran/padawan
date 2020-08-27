<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;

    public function flag()
    {
    	if ($this->flag) {
    		return asset('img/flags/' . $this->flag);
    	}
    	return asset('img/flags/no_flag.png');
    }
}
