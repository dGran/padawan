<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    public $timestamps = false;

    protected $fillable = [
        'name', 'alpha_2', 'alpha_3', 'slug'
    ];

    public function scopeName($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                            $q->where('countries.name', 'LIKE', "%{$value}%")
                                ->orWhere('countries.alpha_2', 'LIKE', "%{$value}%")
                                ->orWhere('countries.alpha_3', 'LIKE', "%{$value}%");
                            });
        }
    }

    public function getFlag(): string
    {
        return $this->getFlag24();
    }

    public function getFlag16(): string
    {
        return asset('img/flags/16x16') . '/' . $this->alpha_2 . '.png';
    }

    public function getFlag24(): string
    {
        return asset('img/flags/24x24') . '/' . $this->alpha_2 . '.png';
    }

    public function getFlag32(): string
    {
        return asset('img/flags/32x32') . '/' . $this->alpha_2 . '.png';
    }

    public function getFlag48(): string
    {
        return asset('img/flags/48x48') . '/' . $this->alpha_2 . '.png';
    }

    public function getFlag64(): string
    {
        return asset('img/flags/64x64') . '/' . $this->alpha_2 . '.png';
    }

    public function getFlag128(): string
    {
        return asset('img/flags/128x128') . '/' . $this->alpha_2 . '.png';
    }
}
