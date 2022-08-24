<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Repositories\EteamMemberRepository;
use App\Http\Services\EteamMemberService;
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

    private EteamMemberRepository $eteamMemberRepository;
    private EteamPostManager $eteamPostManager;
    private EteamLogManager $eteamLogManager;

    public function __construct(
        EteamMemberRepository $eteamMemberRepository,
        EteamPostManager $eteamPostManager,
        EteamLogManager $eteamLogManager
    ) {
        $this->eteamMemberRepository = $eteamMemberRepository;
        $this->eteamPostManager = $eteamPostManager;
        $this->eteamLogManager = $eteamLogManager;
    }

    public function transferTeamOwnership(int $eteamId, int $oldOwnerId, int $newOwnerId): bool
    {
        return $this->eteamMemberRepository->transferTeamOwnership($eteamId, $oldOwnerId, $newOwnerId);
    }

    public function updateCaptainRange(int $eteamId, int $memberId, string $range): void
    {
        //        $admin =
        $user = User::find($memberId);
        $logMessage = '';

        if ($range === 'captain') {
            $this->eteamMemberRepository->grantCaptainRange($eteamId, $memberId);
            $logMessage = $user->name . ' cambia su rango en el equipo, miembro -> capitán';
            $postTitle = $user->name. ' asciende a capitán';
            $postContent = '';
        }

        if ($range === 'member') {
            $this->eteamMemberRepository->removeCaptainRange($eteamId, $memberId);
            $logMessage = $user->name . ' cambia su rango en el equipo, capitán -> miembro';
            $postTitle = $user->name. ' deja la capitanía del equipo';
            $postContent = '';
        }

        $logData = [
            'eteam_id' => $eteamId,
            'user_id' => $memberId,
            'context' => ETeamLog::CONTEXT_MEMBERS,
            'type' => ETeamLog::TYPE_UPDATE,
            'message' => $logMessage
        ];
        $this->eteamLogManager->create($logData);

        $postData = [
            'eteam_id' => $eteamId,
            'user_id' => $memberId,
            'title' => $postTitle,
            'content' => $postContent,
            'public' => false,
            'slug' => Str::slug($postTitle, '-')
        ];
        $this->eteamPostManager->create($postData);

        // enviar personal al usuario implicado y mail a todos los miembros
    }

    public function removeCaptainRange(int $eteamId, int $memberId): void
    {
        $this->eteamMemberRepository->removeCaptainRange($eteamId, $memberId);
    }
}
