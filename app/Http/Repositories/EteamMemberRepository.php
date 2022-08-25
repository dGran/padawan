<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Http\Managers\EteamMemberManager;
use App\Models\ETeamUser;

class EteamMemberRepository
{
    public function transferTeamOwnership(int $eteamId, int $oldOwnerId, int $newOwnerId): bool
    {
        $processResult = false;
        $oldOwner = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $oldOwnerId)->first();
        $newOwner = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $newOwnerId)->first();

        if (empty($oldOwner) || empty($newOwner)) {
            return false;
        }

        $oldOwner->owner = false;

        if ($oldOwner->update()) {
            $processResult = true;
        }

        $newOwner->owner = true;

        if ($newOwner->update()) {
            $processResult = true;
        }

        return $processResult;
    }

    public function updateCaptainRange(int $eteamId, int $memberId, string $range): void
    {
        $member = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $memberId)->first();

        if (empty($member)) {
            return;
        }

        $member->captain = $range === EteamMemberManager::CAPTAIN_RANGE;
        $member->update();
    }
}
