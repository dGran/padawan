<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\ETeamLog;

class EteamLogService
{
    public function getCreateData(array $data): array
    {
        return [
            'eteam_id' => $data['eteam_id'],
            'user_id' => $data['user_id'],
            'context' => $data['context'],
            'type' => $data['type'],
            'message' => $data['message']
        ];
    }

    public function getEteamPostCreateData(array $data): array
    {
        return [
            'eteam_id' => $data['eteam_id'],
            'user_id' => $data['user_id'],
            'context' => ETeamLog::CONTEXT_POSTS,
            'type' => ETeamLog::TYPE_POST,
            'message' => "Nueva noticia creada, '".$data['title']."'"
        ];
    }
}
