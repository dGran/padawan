<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    /**
     * @var bool|mixed
     */
    protected $table = 'notifications';

    protected $fillable = [
        'user_id', 'title', 'content', 'link', 'link_title', 'read', 'slug'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function scopeText($query, $value)
    {
        if (trim($value) != "") {
            return $query->where(function($q) use ($value) {
                $q->where('notifications.title', 'LIKE', "%{$value}%")
                    ->orWhere('notifications.content', 'LIKE', "%{$value}%");
                });
        }
    }

    public function scopeUnread($query, $value)
    {
        if ($value) {
            return $query->where(function($q) {
                $q->where('notifications.read', 0);
            });
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

    public function getDateFromNow()
    {
        return $date = Carbon::now()->$this->date->diffForHumans();
    }

    public function getRead(): bool
    {
        return $this->read;
    }

    public function setRead(bool $read): void
    {
        $this->read = $read;
    }
}
