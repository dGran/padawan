<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamLog extends Model
{
    use HasFactory;

    protected $table = 'eteams_logs';

    protected $fillable = [
        'eteam_id', 'user_id', 'context', 'type', 'message'
    ];

    public const CONTEXT_ETEAM = 'e-team';
    public const CONTEXT_INVITATIONS = 'invitaciones';
    public const CONTEXT_REQUESTS = 'solicitudes';
    public const CONTEXT_MEMBERS = 'miembros';
    public const CONTEXT_POSTS = 'noticias';

    public const TYPE_POST = 'post';
    public const TYPE_UPDATE = 'update';
    public const TYPE_DELETE = 'delete';

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
                $q->where('eteams_logs.message', 'LIKE', "%{$value}%")
                    ->orWhere('eteams_logs.type', 'LIKE', "%{$value}%")
                    ->orWhere('eteams_logs.context', 'LIKE', "%{$value}%")
                    ->orWhere('users.name', 'LIKE', "%{$value}%");
            });
        }
    }

    public function scopeContext($query, $value)
    {
        if ($value) {
            return $query->where(function($q) use ($value) {
                $q->where('eteams_logs.context', $value);
            });
        }
    }

    public function scopeType($query, $value)
    {
        if ($value) {
            return $query->where(function($q) use ($value) {
                $q->where('eteams_logs.type', $value);
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
}
