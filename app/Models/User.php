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

    public function getAvatarUrl()
    {
        if (!$this->profile) {
            return "https://eu.ui-avatars.com/api/?name=" . $this->name;
        }
        return $this->profile->getAvatarUrl();
    }

    public function getFlag()
    {
        $no_flag = 'img/flags/no_flag.png';
        if ($this->profile) {
            if ($this->profile->country_id) {
                return $this->profile->country->getFlag();
            }
            return $no_flag;
        }
        return $no_flag;
    }

    public function isAdminETeam($eteam_id)
    {
        $admin = ETeamUser::where('eteam_id', $eteam_id)
            ->where('user_id', $this->id)
            ->where(function($q) {
                $q->where('owner', 1)
                  ->orWhere('captain', 1);
                })
            ->get();
        return $admin->count() > 0 ? true : false;
    }

    public function unreadNotifications()
    {
        return Notification::where('user_id', $this->id)->where('read', 0)->count();
    }

    public function eteamsInvitations()
    {
        return ETeamInvitation::where('user_id', $this->id)->where('state', 'pending')->count();
    }

    public function eteamInvitation($eteam_id)
    {
        return (ETeamInvitation::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->where('state', 'pending')
            ->count());
    } 

    public function eteamMember($eteam_id)
    {
        return (ETeamUser::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->count());
    }  

    public function eteamRequest($eteam_id)
    {
        return (ETeamRequest::where('user_id', $this->id)
            ->where('eteam_id', $eteam_id)
            ->count());
    }     

    public function eteamRequestState($eteam_id)
    {
        return (ETeamRequest::where('user_id', $this->id)
        ->where('eteam_id', $eteam_id)
        ->first()
        ->state);
    }
}
