<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Cache;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'last_seen',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function hasProfile(): bool {
        if ($this->profile) {
            return true;
        }

        return false;
    }

    /**
     * @return int|void
     */
    public function getAge()
    {
        if ($this->profile && $this->profile->birthdate) {
            return Carbon::parse($this->profile->birthdate)->age;
        }
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        if (!$this->profile) {
            return (string) "https://eu.ui-avatars.com/api/?name=".$this->name;
        }

        return (string) $this->profile->getAvatarUrl();
    }

    /**
     * @return string
     */
    public function getFlag(): string
    {
        $no_flag = 'img/flags/no_flag.png';
        if ($this->profile) {
            if ($this->profile->country_id) {
                return $this->profile->country->getFlag();
            }

            return (string) $no_flag;
        }

        return (string) $no_flag;
    }

    /**
     * @return bool
     */
    public function hasAnySocialNetwork(): bool
    {
        return $this->profile && ($this->profile->whatsapp || $this->profile->facebook || $this->profile->instagram || $this->profile->twitter || $this->profile->twitch || $this->profile->discord);
    }

    /**
     * @return bool
     */
    public function hasAnyGamerProfile(): bool
    {
        return $this->profile && ($this->profile->xbox_id || $this->profile->ps_id || $this->profile->steam_id || $this->profile->origin_id);
    }

    /**
     * @return bool
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }

    /**
     * @param $eteam_id
     * @return int
     */
    public function isEteamMember($eteam_id): bool
    {
        return (bool) ETeamUser::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->count();
    }

    /**
     * @param int $gameId
     * @return bool
     */
    public function isMemberEteamGame(int $gameId): bool
    {
        $userEteamsWithGameId = ETeamUser::
            with([
                "eteam" => function ($query) use ($gameId) {
                    $query->where('eteam.game_id', '=', $gameId);
                },
            ])
            ->where('user_id', $this->id)
            ->count();

        return $userEteamsWithGameId > 0;
    }

    public function isAdminETeam(int $eteam_id): bool
    {
        $query = ETeamUser::where('eteam_id', $eteam_id)
            ->select('id')
            ->where('user_id', $this->id)
            ->where(function ($q) {
                $q->where('owner', 1)
                    ->orWhere('captain', 1);
            })
            ->count();

        return $query === 1;
    }

    public function isOwnerETeam(int $eteam_id): bool
    {
        $query = ETeamUser::where('eteam_id', $eteam_id)
            ->select('id')
            ->where('user_id', $this->id)
            ->where('owner', 1)
            ->count();

        return $query === 1;
    }

    public function eteamInvitation(int $eteam_id): int
    {
        return (int) ETeamInvitation::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->where('state', 'pending')
            ->count();
    }

    public function eteamRequest(int $eteam_id): int
    {
        return (int) (ETeamRequest::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->count());
    }

    public function eteamRequestState(int $eteam_id): string
    {
        $state = (ETeamRequest::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->first()
            ->state);

        switch ($state) {
            case 'pending':
                return (string) 'pendiente';
                break;
            case 'refused':
                return (string) 'rechazada';
                break;
            default:
                return '';
        }
    }

    /**
     * @return Collection
     */
    public function getMyEteams(): Collection
    {
        return ETeamUser::with('eteam')
            ->where('user_id', $this->id)
            ->where('active', 1)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * @return array|null
     */
    public function getMyTeamsWhereIamAdminIds(): ?array
    {
        $myTeamsWhereIamAdminIds = [];
        $myTeamsWhereIamAdmin = ETeamUser::select('eteam_id')->where('user_id', $this->id)->where('captain',
            1)->where('active', 1)->get();

        if ($myTeamsWhereIamAdmin->count() > 0) {
            foreach ($myTeamsWhereIamAdmin as $eteam) {
                $myTeamsWhereIamAdminIds[] = $eteam->eteam_id;
            }
        }

        return $myTeamsWhereIamAdminIds;
    }

    public function getEteamsInvitations(): Collection
    {
        return ETeamInvitation::where('user_id', $this->id)->where('state', 'pending')->orderBy('created_at',
            'desc')->get();
    }

    public function countEteamsInvitations(): ?int
    {
        return (int) ETeamInvitation::where('user_id', $this->id)->where('state', 'pending')->count();
    }

    public function getEteamRequests(): Collection
    {
        return ETeamRequest::where('user_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    public function getMyEteamsInvitations(): Collection
    {
        $myTeamsWhereIamAdminIds = $this->getMyTeamsWhereIamAdminIds();

        return ETeamInvitation::whereIn('eteam_id', [$myTeamsWhereIamAdminIds])->orderBy('created_at', 'desc')->get();
    }

    public function countMyEteamsInvitations(): ?int
    {
        $myTeamsWhereIamAdminIds = $this->getMyTeamsWhereIamAdminIds();

        if ($myTeamsWhereIamAdminIds) {
            return (int) ETeamInvitation::whereIn('eteam_id', [$myTeamsWhereIamAdminIds])->where('state', 'pending')->count();
        }

        return null;
    }

    public function getMyEteamsRequests(): Collection
    {
        $myTeamsWhereIamAdminIds = $this->getMyTeamsWhereIamAdminIds();

        return ETeamRequest::whereIn('eteam_id', [$myTeamsWhereIamAdminIds])->where('state',
            'pending')->orderBy('created_at', 'desc')->get();
    }

    public function countMyEteamsRequests(): ?int
    {
        $myTeamsWhereIamAdminIds = $this->getMyTeamsWhereIamAdminIds();

        if ($myTeamsWhereIamAdminIds) {
            return (int) ETeamRequest::whereIn('eteam_id', [$myTeamsWhereIamAdminIds])->where('state', 'pending')->count();
        }

        return null;
    }

    public function countEteamsNotifications(): int
    {
        return $this->countEteamsInvitations() + $this->countMyEteamsInvitations() + $this->countMyEteamsRequests();
    }

    public function countNotifications(): ?int
    {
        return (int) Notification::where('user_id', $this->id)->unread(true)->count();
    }

    public function countTotalNotifications(): int
    {
        return $this->countNotifications() + $this->countEteamsInvitations() + $this->countMyEteamsInvitations() + $this->countMyEteamsRequests();
    }

}
