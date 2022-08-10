<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Str;

class NotificationService
{
    public function getCreateData(array $data): array
    {
        return [
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'link' => $data['link'],
            'link_title' => $data['link_title'],
            'read' => $data['read'],
            'slug' => Str::slug($data['title'], '-'),
        ];
    }

    public function getCreateToEteamAdminsData(User $admin, array $data): array
    {
        return [
            'user_id' => $admin->user_id,
            'title' => $data['title'],
            'content' => $data['content'],
            'link' => Route($data['link'], $data['linkParams']),
            'link_title' => $data['linkTitle'],
            'read' => 0,
        ];
    }
}
