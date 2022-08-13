<?php

declare(strict_types=1);

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

    public function scopeSearch($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                $q->where('eteams_posts.title', 'LIKE', "%{$value}%")
                    ->orWhere('eteams_posts.content', 'LIKE', "%{$value}%")
                    ->orWhere('eteams_posts.id', 'LIKE', "%{$value}%")
                    ->orWhere('users.name', 'LIKE', "%{$value}%");
            });
        }
    }

    public function scopeVisibility($query, $value)
    {
        if ($value !== 'all') {
            if ($value === 'pública') {
                return $query->where('eteams_posts.public', 1);
            }

            return $query->where('eteams_posts.public', 0);
        }
    }

    public function getCreatedAtDate()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("LL");
    }

    public function getCreatedAtTime()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("H[:]mm");
    }

    public function getUpdatedAtDate()
    {
        return Carbon::parse($this->updated_at)->locale(app()->getLocale())->isoFormat("LL");
    }

    public function getUpdatedAtTime()
    {
        return Carbon::parse($this->updated_at)->locale(app()->getLocale())->isoFormat("H[:]mm");
    }

    public function isUpdated(): bool
    {
        return $this->created_at < $this->updated_at;
    }
}
