<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tablezone extends Model
{
	protected $fillable = ['name', 'img'];
    public $timestamps = false;
}
