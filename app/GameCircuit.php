<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameCircuit extends Model
{
    protected $table = 'games_circuits';

	protected $fillable = ['game_id', 'name', 'img', 'length', 'country_id'];
    public $timestamps = false;

    public function game()
    {
        return $this->belongsTo('App\Game');
    }

    public function country()
    {
        return $this->hasOne('App\Country', 'id', 'country_id');
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function scopeGame($query, $game)
    {
        if ($game > 0) {
            $query->where("game_id", "=", $game);
        }
    }

    public function scopeCountry($query, $country)
    {
        if ($country > 0) {
            $query->where("country_id", "=", $country);
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }

    public function flag()
    {
        if ($this->country_id) {
            return asset('img/flags/' . $this->country->flag);
        }
        return asset('img/flags/no_flag.png');
    }

    public function country_name()
    {
        if ($this->country_id) {
            return $this->country->name;
        }
        return "N/D";
    }

    public function length()
    {
        if ($this->length > 0) {
            return number_format($this->length, 0, ',', '.') . ' km';
        }
        return "N/D";
    }

    public function img()
    {
        $default = asset('img/circuits/default.png');
        $custom = asset('img/circuits/' . $this->img);

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
