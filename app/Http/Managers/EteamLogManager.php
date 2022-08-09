<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\EteamLogService;
use App\Models\ETeamLog;

class EteamLogManager
{
    private EteamLogService $eteamLogService;

    public function __construct(EteamLogService $eteamLogService)
    {
        $this->eteamLogService = $eteamLogService;
    }

    public function create(array $data): void
    {
        ETeamLog::create($this->eteamLogService->getCreateData($data));
    }

    public function createEteamPostLog(array $data): void
    {
        ETeamLog::create($this->eteamLogService->getEteamPostCreateData($data));
    }
}
