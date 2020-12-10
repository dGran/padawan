<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    protected $fillable = [
        'avatar', 'birthdate', 'location', 'ps_id', 'xbox_id', 'steam_id', 'origin_id', 'whatsapp', 'twitter', 'facebook', 'instagram'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function avatar()
    {
        $default = asset('img/avatars/default.png');
        $custom = asset('img/avatars/' . $this->avatar);

        if ($this->avatar) {
            if ($this->check_img($custom)) {
                return $custom;
            }
        }
		return $default;
    }

    public function years()
    {
    	if ($this->birthdate) {
    		return Carbon::createFromDate($this->birthdate)->age . ' años';
    	}

    	return null;
    }

    protected function check_img($image) {
        if (!$image) return FALSE;
        // $headers = get_headers($image);
        // return stripos($headers[0], "200 OK") ? TRUE : FALSE;
        return true;
    }
}
