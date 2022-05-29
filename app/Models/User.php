<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile() {
        return $this->hasOne('App\Models\Profile');
    }

    public function getAge()
    {
        if ($this->profile && $this->profile->birthdate) {
            return Carbon::parse($this->profile->birthdate)->age;
        }
    }

    public function getAvatarUrl(): string
    {
        if (!$this->profile) {
            return (string)"https://eu.ui-avatars.com/api/?name=" . $this->name;
        }
        return (string)$this->profile->getAvatarUrl();
    }

    public function getFlag(): string
    {
        $no_flag = 'img/flags/no_flag.png';
        if ($this->profile) {
            if ($this->profile->country_id) {
                return $this->profile->country->getFlag();
            }
            return (string)$no_flag;
        }
        return (string)$no_flag;
    }

    public function isAdminETeam($eteam_id): bool
    {
        $admin = ETeamUser::where('eteam_id', $eteam_id)
            ->where('user_id', $this->id)
            ->where(function($q) {
                $q->where('owner', 1)
                  ->orWhere('captain', 1);
                })
            ->get();
        return (bool)$admin->count() > 0 ? true : false;
    }

    public function eteamInvitation($eteam_id): int
    {
        return (int)ETeamInvitation::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->where('state', 'pending')
            ->count();
    } 

    public function eteamMember($eteam_id): int
    {
        return (int)ETeamUser::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->count();
    }  

    public function eteamRequest(int $eteam_id): int
    {
        return (int)(ETeamRequest::where('user_id', $this->id)
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
                return (string)'pendiente';
                break;
            case 'refused':
                return (string)'rechazada';
                break;
        }
    }

    public function countTotalNotifications(): int
    {
        return (int)$this->countNotifications() + $this->countInvitations();
    }

    public function countNotifications(): int
    {
        return (int)Notification::where('user_id', $this->id)->unread(true)->count();
    }

    public function countInvitations(): int
    {
        return (int)ETeamInvitation::where('user_id', $this->id)->where('state', 'pending')->count();
    }
}
