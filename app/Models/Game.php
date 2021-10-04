<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';
    public $timestamps = false;

    protected $fillable = [
        'name', 'logo', 'banner', 'racing', 'allow_eteams'
    ];

    public function getLogo()
    {
        return asset('img/games/logos/' . $this->slug . '.png');
    }

    public function getBanner()
    {
        return asset('img/games/banners/' . $this->slug . '.jpeg');
    }

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('games.name', 'LIKE', "%{$value}%");
                            });
        }
    }
}
