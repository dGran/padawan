<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ETeamUser extends Model
{
    use HasFactory;

    protected $table = 'eteams_users';

    protected $fillable = [
        'eteam_id', 'user_id', 'owner', 'captain', 'active', 'name', 'img', 'game_position_id', 'contract_from', 'contract_to'
    ];

    public const RANGE_OWNER = 'propietario';
    public const RANGE_CAPTAIN = 'capitan';
    public const RANGE_MEMBER = 'miembro';
    protected const RANGE_OWNER_COLOR = 'purple';
    protected const RANGE_CAPTAIN_COLOR = 'rose';
    protected const RANGE_MEMBER_COLOR = 'edgray';

    public function eteam()
    {
        return $this->belongsTo('App\Models\ETeam', 'eteam_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function scopeSearch($query, $value)
    {
        if (trim($value) !== "") {
            return $query->where(function($q) use ($value) {
                $q->where('users.name', 'LIKE', "%{$value}%");
            });
        }
    }

    public function scopeRange($query, $value)
    {
        if (trim($value) !== "all") {
            if ($value === self::RANGE_OWNER) {
                return $query->where('eteams_users.owner', '=', true);
            }

            if ($value === self::RANGE_CAPTAIN) {
                return $query->where('eteams_users.captain', true)
                    ->orWhere('eteams_users.owner', true);
            }

            if ($value === self::RANGE_MEMBER) {
                return $query->where('eteams_users.owner', false)
                    ->where('eteams_users.captain', false);
            }
        }
    }

    public function getName()
    {
        return $this->name ? $this->name : $this->user->name;
    }

    public function getImgUrl()
    {
        if (!$this->img) {
            if ($this->isRacing()) {
                return "https://toksport.com/wp-content/uploads/2020/07/race-driver-empty-compressor.png";
            } else {
                return "https://images.vexels.com/media/users/3/132248/isolated/preview/e3825a50d945f17953fb51192ed4047d-silueta-de-jugador-de-futbol.png";
            }
        }
        return $this->img;
    }

    public function getRangeProps(): array
    {
        if ($this->owner) {
            return ['text' => self::RANGE_OWNER, 'color' => self::RANGE_OWNER_COLOR];
        }

        if ($this->captain) {
            return ['text' => self::RANGE_CAPTAIN, 'color' => self::RANGE_CAPTAIN_COLOR];
        }

        return ['text' => self::RANGE_MEMBER, 'color' => self::RANGE_MEMBER_COLOR];
    }

    public function isRacing()
    {
        return $this->eteam->game->racing ? true : false;
    }

    public function getCreatedAtDate()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("LL");
    }

    public function getCreatedAtTime()
    {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->isoFormat("H[:]mm");
    }

    public function getContractFromDate()
    {
        if (empty($this->contractFrom)) {
            return null;
        }

        return Carbon::parse($this->contractFrom)->locale(app()->getLocale())->isoFormat("LL");
    }

    public function getContractToDate()
    {
        if (empty($this->contractTo)) {
            return null;
        }

        return Carbon::parse($this->contractTo)->locale(app()->getLocale())->isoFormat("LL");
    }
}
