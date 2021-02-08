<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeasonPost extends Model
{
    protected $table = 'seasons_posts';
	protected $fillable = ['season_id', 'type', 'img', 'title', 'content', 'slug'];

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
            $query->where("title", "LIKE", "%$name%");
        }
    }

    public function scopeType($query, $type)
    {
        if (trim($type) !="") {
            $query->where("type", "=", $type);
        }
    }

    public function img()
    {
        switch ($this->type) {
            case 'default':
                $default = asset('img/seasons_posts/default.png');
                break;
            case 'participation':
                $default = asset('img/seasons_posts/participation.png');
                break;
            case 'transfer':
                $default = asset('img/seasons_posts/transfer.png');
                break;
            case 'result':
                $default = asset('img/seasons_posts/result.png');
                break;
            case 'champion':
                $default = asset('img/seasons_posts/champion.png');
                break;
            case 'press':
                $default = asset('img/seasons_posts/press.png');
                break;
        }

        $custom = asset('img/seasons_posts/' . $this->img);

        if ($this->img) {
            if ($this->check_img($custom)) {
                return $custom;
            }
        }
        return $default;
    }

    protected function check_img($image) {
        if (!$image) return FALSE;
        // $headers = get_headers($image);
        // return stripos($headers[0], "200 OK") ? TRUE : FALSE;
        return true;
    }

    public function type_name()
    {
        switch ($this->type) {
            case 'default':
                return 'Regular';
                break;
            case 'result':
                return 'Resultados';
                break;
            case 'participation':
                return 'Participación';
                break;
            case 'transfer':
                return 'Fichajes';
                break;
            case 'press':
                return 'Prensa';
                break;
            case 'champion':
                return 'Campeones';
                break;
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }
}
