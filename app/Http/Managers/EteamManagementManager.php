<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Repositories\EteamManagementRepository;
use App\Models\ETeam;
use App\Models\ETeamLog;
use App\Models\User;
use Illuminate\Support\Str;

class EteamManagementManager
{
    private EteamManagementRepository $eteamManagementRepository;
    private EteamPostManager $eteamPostManager;
    private EteamLogManager $eteamLogManager;
    private EteamMemberManager $eteamMemberManager;
    private NotificationManager $notificationManager;

    public function __construct(
        EteamManagementRepository $eteamManagementRepository,
        EteamPostManager $eteamPostManager,
        EteamLogManager $eteamLogManager,
        EteamMemberManager $eteamMemberManager,
        NotificationManager $notificationManager
    ) {
        $this->eteamManagementRepository = $eteamManagementRepository;
        $this->eteamPostManager = $eteamPostManager;
        $this->eteamLogManager = $eteamLogManager;
        $this->eteamMemberManager = $eteamMemberManager;
        $this->notificationManager = $notificationManager;
    }

    public function sendInvitation(ETeam $eteam, User $admin, User $user): void
    {
        $adminId = $this->eteamMemberManager->getIdByEteamIdAndUserId($eteam->id, $admin->id);
        $this->eteamManagementRepository->sendInvitation($eteam->id, $adminId, $user->id);

        $logMessage = 'Invitación de ingreso enviada al usuario '.$user->name;
        $userNotificationTitle = "Has recibido una invitación del equipo $eteam->name";
        $userNotificationContent = "$admin->name te ha invitado para ingresar en el equipo $eteam->name";
        $adminsNotificationTitle = $logMessage;
        $adminsNotificationContent = $admin->name.' ha invitado a '.$user->name.' para ingresar en el equipo';;

//        create log
        $logData = [
            'eteam_id' => $eteam->id,
            'user_id' => $admin->id,
            'context' => ETeamLog::CONTEXT_INVITATIONS,
            'type' => ETeamLog::TYPE_POST,
            'message' => $logMessage
        ];
        $this->eteamLogManager->create($logData);

//        user notification
        $this->notificationManager->create([
            'user_id' => $user->id,
            'title' => $userNotificationTitle,
            'content' => $userNotificationContent,
            'link' => Route('my-teams'),
            'link_title' => 'Mis equipos',
            'read' => 0
        ]);

//        admins notifications
        $adminsNotificationData = [
            'title' => $adminsNotificationTitle,
            'content' => $adminsNotificationContent,
            'link' => Route('notifications'),
            'link_title' => 'Notificaciones',
            'read' => 0
        ];

        $excludeIds = [$admin->id];
        $this->notificationManager->createToEteamAdmins($eteam, $adminsNotificationData, $excludeIds);
    }
}
