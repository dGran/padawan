<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamPost extends Model
{
    use HasFactory;

    protected $table = 'eteams_posts';

    protected $fillable = [
        'eteam_id', 'user_id', 'title', 'content'
    ];

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }
}
