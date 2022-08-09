<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\MailService;
use App\Http\Services\NotificationService;
use App\Http\Services\UserService;
use App\Models\Notification;
use App\Models\User;

class NotificationManager
{
    private NotificationService $notificationService;
    private MailService $mailService;

    public function __construct
    (
        NotificationService $notificationService,
        MailService $mailService,
    ) {
        $this->notificationService = $notificationService;
        $this->mailService = $mailService;
    }

    public function create(array $data): void
    {
        Notification::create($this->notificationService->getCreateData($data));
        $user = User::find($data['user_id']);

        if (empty($user)) {
            return;
        }

        $this->mailService->sendMailNotification($user, $data['title'], $data['content']);
    }
}