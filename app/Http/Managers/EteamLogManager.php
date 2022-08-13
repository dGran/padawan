<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\EteamLogService;
use App\Models\ETeamLog;

class EteamLogManager
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
        'context' => [
            'field' => 'context',
            'direction' => 'asc',
        ],
        'context_desc' => [
            'field' => 'context',
            'direction' => 'desc',
        ],
        'type' => [
            'field' => 'type',
            'direction' => 'asc',
        ],
        'type_desc' => [
            'field' => 'type',
            'direction' => 'desc',
        ],
        'message' => [
            'field' => 'message',
            'direction' => 'asc',
        ],
        'message_desc' => [
            'field' => 'message',
            'direction' => 'desc',
        ],
        'created_at' => [
            'field' => 'created_at',
            'direction' => 'asc',
        ],
        'created_at_desc' => [
            'field' => 'created_at',
            'direction' => 'desc',
        ]
    ];

    private EteamLogService $eteamLogService;

    public function __construct(EteamLogService $eteamLogService)
    {
        $this->eteamLogService = $eteamLogService;
    }

    public function create(array $data): void
    {
        ETeamLog::create($this->eteamLogService->getCreateData($data));
    }

    public function createEteamPostCreateLog(array $data): void
    {
        ETeamLog::create($this->eteamLogService->getEteamPostCreateData($data));
    }

    public function createEteamPostUpdateLog(array $data): void
    {
        ETeamLog::create($this->eteamLogService->getEteamPostUpdateData($data));
    }

    public function createEteamPostDeleteLog(array $data): void
    {
        ETeamLog::create($this->eteamLogService->getEteamPostDeleteData($data));
    }
}
