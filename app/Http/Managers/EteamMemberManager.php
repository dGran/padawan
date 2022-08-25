<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Repositories\EteamMemberRepository;
use App\Models\ETeam;
use App\Models\ETeamLog;
use App\Models\User;
use Illuminate\Support\Str;

class EteamMemberManager
{
    public const ORDER_VALUES = [
        'user' => [
            'field' => 'username',
            'direction' => 'asc',
        ],
        'user_desc' => [
            'field' => 'username',
            'direction' => 'desc',
        ],
        'range' => [
            'field' => 'captain',
            'direction' => 'asc',
        ],
        'range_desc' => [
            'field' => 'captain',
            'direction' => 'desc',
        ],
        'created_at' => [
            'field' => 'created_at',
            'direction' => 'asc',
        ],
        'created_at_desc' => [
            'field' => 'created_at',
            'direction' => 'desc',
        ],
        'contract_from' => [
            'field' => 'contract_from',
            'direction' => 'asc',
        ],
        'contract_from_desc' => [
            'field' => 'contract_from',
            'direction' => 'desc',
        ],
        'contract_to' => [
            'field' => 'contract_to',
            'direction' => 'asc',
        ],
        'contract_to_desc' => [
            'field' => 'contract_to',
            'direction' => 'desc',
        ],
    ];

    public const REG_NOT_EXISTS = 'El usuario ya no pertenece al equipo';
    public const CAPTAIN_RANGE = 'captain';
    public const MEMBER_RANGE = 'member';

    private EteamMemberRepository $eteamMemberRepository;
    private EteamPostManager $eteamPostManager;
    private EteamLogManager $eteamLogManager;
    private NotificationManager $notificationManager;

    public function __construct(
        EteamMemberRepository $eteamMemberRepository,
        EteamPostManager $eteamPostManager,
        EteamLogManager $eteamLogManager,
        NotificationManager $notificationManager
    ) {
        $this->eteamMemberRepository = $eteamMemberRepository;
        $this->eteamPostManager = $eteamPostManager;
        $this->eteamLogManager = $eteamLogManager;
        $this->notificationManager = $notificationManager;
    }

    public function transferTeamOwnership(int $eteamId, int $oldOwnerId, int $newOwnerId): bool
    {
        return $this->eteamMemberRepository->transferTeamOwnership($eteamId, $oldOwnerId, $newOwnerId);
    }

    public function updateCaptainRange(int $eteamId, int $memberId, int $adminId, string $range): void
    {
        $admin = User::find($adminId);
        $user = User::find($memberId);
        $eteam = ETeam::find($eteamId);

        if ($range !== self::CAPTAIN_RANGE && $range !== self::MEMBER_RANGE) {
            return;
        }

        if ($range === self::CAPTAIN_RANGE) {
            $this->eteamMemberRepository->updateCaptainRange($eteamId, $memberId, self::CAPTAIN_RANGE);
            $logMessage = $user->name.' cambia su rango en el equipo, miembro -> capitán';
            $postTitle = $user->name.' asciende a capitán';
            $postContent = $admin->name.' otorga el rango de capitán a '.$user->name;
            $userNotificationTitle = "Te han ascendido a capitán";
            $userNotificationContent = "Felicidades, $admin->name te ha ascendido a capitán del equipo $eteam->name. A partir de ahora tienes disponible el menú de admin del equipo";
            $membersNotificationTitle = "$user->name nuevo capitán del equipo $eteam->name";
            $membersNotificationContent = "$user->name ha sido ascendido a capitán del equipo $eteam->name";
        }

        if ($range === self::MEMBER_RANGE) {
            $this->eteamMemberRepository->updateCaptainRange($eteamId, $memberId, self::MEMBER_RANGE);
            $logMessage = $user->name.' cambia su rango en el equipo, capitán -> miembro';
            $postTitle = $user->name.' deja de ser capitán';
            $postContent = $admin->name.' elimina el rango de capitán a '.$user->name;
            $userNotificationTitle = "Te han retirado el rango de capitán";
            $userNotificationContent = "$admin->name te ha retirado el rango de capitán del equipo $eteam->name";
            $membersNotificationTitle = "$user->name deja de ser capitán del equipo $eteam->name";
            $membersNotificationContent = "$user->name deja de ser capitán del equipo $eteam->name";
        }

//        create log
        $logData = [
            'eteam_id' => $eteamId,
            'user_id' => $memberId,
            'context' => ETeamLog::CONTEXT_MEMBERS,
            'type' => ETeamLog::TYPE_UPDATE,
            'message' => $logMessage
        ];
        $this->eteamLogManager->create($logData);

//        create post
        $postData = [
            'eteam_id' => $eteamId,
            'user_id' => $memberId,
            'title' => $postTitle,
            'content' => $postContent,
            'public' => false,
            'slug' => Str::slug($postTitle, '-')
        ];
        $this->eteamPostManager->create($postData);

//        user mail notification
        $this->notificationManager->create([
            'user_id' => $user->id,
            'title' => $userNotificationTitle,
            'content' => $userNotificationContent,
            'link' => Route('eteam', $eteam->slug),
            'link_title' => $eteam->name,
            'read' => 0
        ]);

//        members mail notifications
        $membersNotificationData = [
            'title' => $membersNotificationTitle,
            'content' => $membersNotificationContent,
            'link' => Route('eteam', $eteam->slug),
            'link_title' => $eteam->name,
            'read' => 0
        ];
        $excludeIds = [$user->id, $admin->id];
        $this->notificationManager->createToEteamMembers($eteam, $membersNotificationData, $excludeIds);
    }
}
