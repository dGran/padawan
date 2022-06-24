<?php

declare(strict_types=1);

use App\Models\ETeam;
use App\Models\Notification;
use App\Models\User;

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

/**
 * @param  ETeam  $eteam
 * @param  int|null  $fromUserId
 * @param  string  $title
 * @param  string  $content
 * @param  string  $link
 * @param  array|null  $linkParams
 * @param  string  $linkTitle
 * @return void
 */
function eteamCaptainsNotification(
    Eteam $eteam,
    ?int $fromUserId,
    string $title,
    string $content,
    string $link,
    ?array $linkParams,
    string $linkTitle
): void {
    foreach ($eteam->getCaptains() as $captain) {
        $notification_data = [
            'user_id' => $captain->user_id,
            'from_user_id' => $fromUserId,
            'title' => $title,
            'content' => $content,
            'link' => Route($link, $linkParams),
            'link_title' => $linkTitle,
            'read' => 0,
        ];
        storeNotification($notification_data);
    }
}
