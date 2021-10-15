<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        return Storage::url($this->logo);
    }

    public function getBanner()
    {
        return Storage::url($this->banner);
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
