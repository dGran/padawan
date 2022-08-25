<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Mail\NotificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;

class MailService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function sendMailNotification(User $user, string $title, string $content): void
    {
        $userHasMailNotificationsActive = $this->userService->hasMailNotificationsActive($user);

        if (!$userHasMailNotificationsActive) {
            return;
        }

        $subject = $title;
        $details = [
            'title' => $title,
            'body' => $content
        ];

        dispatch(new SendEmailJob($user->email, $subject, $details));
    }
}
