<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\MailService;
use App\Http\Services\NotificationService;
use App\Models\ETeam;
use App\Models\Notification;
use App\Models\User;

class NotificationManager
{
    private NotificationService $notificationService;
    private MailService $mailService;

    public function __construct
    (
        NotificationService $notificationService,
        MailService $mailService
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

    function createToEteamAdmins(ETeam $eteam, array $data): void
    {
        $admins = $eteam->getCaptains();

        if (empty($admins)) {
            return;
        }

        foreach ($admins as $admin) {
            $this->create($this->notificationService->getCreateMultipleMembersData($admin->user_id, $data));
        }
    }

    function createToEteamMembers(ETeam $eteam, array $membersNotificationData, ?array $excludeIds): void
    {
        $members = $eteam->getMembers($excludeIds);

        if (empty($members)) {
            return;
        }

        foreach ($members as $member) {
            $this->create($this->notificationService->getCreateMultipleMembersData($member->user_id, $membersNotificationData));
        }
    }
}
