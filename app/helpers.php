<?php
declare(strict_types=1);

use App\Models\Notification;

function storeNotification($data): void
{
    Notification::create([
        'user_id' => $data['user_id'],
        'from_user_id' => $data['from_user_id'],
        'title' => $data['title'],
        'content' => $data['content'],
        'link' => $data['link'],
        'link_title' => $data['link_title'],
        'read' => $data['read'],
    ]);
}
