<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Repositories\EteamMemberRepository;
use App\Http\Services\EteamMemberService;

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

    private EteamMemberService $eteamMemberService;
    private EteamMemberRepository $eteamMemberRepository;

    public function __construct(
        EteamMemberService $eteamMemberService,
        EteamMemberRepository $eteamMemberRepository
    ) {
        $this->eteamMemberService = $eteamMemberService;
        $this->eteamMemberRepository = $eteamMemberRepository;
    }

    public function transferTeamOwnership(int $eteamId, int $oldOwnerId, int $newOwnerId): bool
    {
        return $this->eteamMemberRepository->transferTeamOwnership($eteamId, $oldOwnerId, $newOwnerId);
    }

    public function grantCaptainRange(int $eteamId, int $memberId): bool
    {
        return $this->eteamMemberRepository->grantCaptainRange($eteamId, $memberId);
    }

    public function removeCaptainRange(int $eteamId, int $memberId): bool
    {
        return $this->eteamMemberRepository->removeCaptainRange($eteamId, $memberId);
    }
}
