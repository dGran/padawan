<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Http\Managers\EteamMemberManager;
use App\Models\ETeamUser;

class EteamMemberRepository
{
    public function getIdByEteamIdAndUserId(int $eteamId, int $userId): int
    {
        return ETeamUser::select('id')
            ->where('eteam_id', $eteamId)
            ->where('user_id', $userId)
            ->where('captain', 1)
            ->first()
            ->id;
    }

    public function transferTeamOwnership(int $eteamId, int $oldOwnerId, int $newOwnerId): void
    {
        $oldOwner = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $oldOwnerId)->first();
        $newOwner = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $newOwnerId)->first();

        if (empty($oldOwner) || empty($newOwner)) {
            return;
        }

        $oldOwner->owner = false;
        $oldOwner->update();
        $newOwner->owner = true;
        $newOwner->update();
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

    public function remove(int $eteamId, int $memberId): void
    {
        $member = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $memberId)->first();

        if (empty($member)) {
            return;
        }

        if (!$member->canDestroy()) {
            $this->desactivate($member);

            return;
        }

        $member->delete();
    }

    public function desactivate(ETeamUser $member): void
    {
        $member->active = 0;
        $member->update();
    }
}
