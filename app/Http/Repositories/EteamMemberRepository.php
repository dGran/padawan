<?php

declare(strict_types=1);

namespace App\Http\Repositories;

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

    public function grantCaptainRange(int $eteamId, int $memberId): void
    {
        $member = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $memberId)->first();

        if (empty($member)) {
            return;
        }

        $member->captain = true;
        $member->update();
    }

    public function removeCaptainRange(int $eteamId, int $memberId): void
    {
        $member = ETeamUser::where('eteam_id', $eteamId)->where('user_id', $memberId)->first();

        if (empty($member)) {
            return;
        }

        $member->captain = false;
        $member->update();
    }
}
