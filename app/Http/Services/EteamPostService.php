<?php

declare(strict_types=1);

namespace App\Http\Services;

use Illuminate\Support\Str;

class EteamPostService
{
    public function getCreateData(array $data): array
    {
        return [
            'eteam_id' => $data['eteam_id'],
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'public' => $data['public'] ?? true,
            'slug' => Str::slug($data['title'], '-')
        ];
    }
}
