<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\ETeamInvitation;

class EteamManagementRepository
{
    public function sendInvitation(int $eteamId, int $adminId, int $userId): void
    {
        ETeamInvitation::create([
            'eteam_id' => $eteamId,
            'captain_id' => $adminId,
            'user_id' => $userId,
            'state' => ETeamInvitation::STATE_PENDING,
            'contract_from' => null,
            'contract_to' => null,
            'message' => null
        ]);
    }
}
