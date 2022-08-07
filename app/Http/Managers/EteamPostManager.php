<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Repositories\EteamPostRepository;
use App\Models\ETeamPost;

class EteamPostManager
{
    private EteamPostRepository $eteamPostRepository;

    public function __construct(EteamPostRepository $eteamPostRepository)
    {
        $this->eteamPostRepository = $eteamPostRepository;
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
