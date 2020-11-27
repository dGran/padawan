<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at', 'is_admin', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function positions()
    {
        return $this->hasMany('App\UserPosition', 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'user_id');
    }

    public function scopeName($query, $name)
    {
        if (trim($name) !="") {
            $query->where("name", "LIKE", "%$name%");
        }
    }

    public function scopeOnlyAdmin($query, $value)
    {
        if ($value) {
            return $query->where('is_Admin', $value);
        } else {
            return $query;
        }
    }

    public function scopeOnlyVerified($query, $value)
    {
        if ($value) {
            return $query->whereNotNull('email_verified_at');
        } else {
            return $query;
        }
    }

    public function scopeOnlyNotVerified($query, $value)
    {
        if ($value) {
            return $query->whereNull('email_verified_at');
        } else {
            return $query;
        }
    }

    public function canDestroy()
    {
        // apply logic...
        // defaults return true

        return true;
    }

    public function notifications_unread()
    {
        return true;
    }
}
