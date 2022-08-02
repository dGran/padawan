<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ETeamPost extends Model
{
    use HasFactory;

    protected $table = 'eteams_posts';

    protected $fillable = [
        'eteam_id', 'user_id', 'title', 'content', 'public', 'slug'
    ];

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getCreatedAtDate()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("LL");
    }

    public function getCreatedAtTime()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("H[:]mm");
    }
}
