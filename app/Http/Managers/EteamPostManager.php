<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\EteamPostService;
use App\Models\ETeamPost;

class EteamPostManager
{
    private EteamPostService $eteamPostService;
    private EteamLogManager $eteamLogManager;

    public function __construct
    (
        EteamPostService $eteamPostService,
        EteamLogManager $eteamLogManager
    ) {
        $this->eteamPostService = $eteamPostService;
        $this->eteamLogManager = $eteamLogManager;
    }

    public function create(array $data): void
    {
        ETeamPost::create($this->eteamPostService->getCreateData($data));
        $this->eteamLogManager->createEteamPostLog($data);
    }

    public function delete(EteamPost $eteamPost): void
    {
        $eteamPost->delete();
    }

    public function update(EteamPost $eteamPost): void
    {
        $eteamPost->update();
    }
}
