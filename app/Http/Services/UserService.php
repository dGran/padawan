<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function hasMailNotificationsActive(User $user): bool
    {
        if (empty($user->profile)) {
            return false;
        }

        return $user->profile->notifications;
    }
}
