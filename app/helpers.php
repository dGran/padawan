<?php

declare(strict_types=1);

use App\Mail\NotificationMail;
use App\Models\ETeam;
use App\Models\ETeamLog;
use App\Models\ETeamPost;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * @param $value
 * @return string
 */
function numberFormatInt($value): string
{
    return number_format($value, 0, ',', '.');
}

/**
 * @param $data
 * @return void
 */
function storeNotification($data): void
{
    Notification::create([
        'user_id' => $data['user_id'],
        'title' => $data['title'],
        'content' => $data['content'],
        'link' => $data['link'],
        'link_title' => $data['link_title'],
        'read' => $data['read'],
        'slug' => Str::slug($data['title'], '-'),
    ]);

    $user = User::find($data['user_id']);
    if ($user && $user->profile && $user->profile->notifications)
    {
        $subject = $data['title'];
        $details = [
            'title' => $data['title'],
            'body' => $data['content']
        ];

        Mail::to($user->email)->send(new NotificationMail($subject, $details));
    }
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
            'title' => $title,
            'content' => $content,
            'link' => Route($link, $linkParams),
            'link_title' => $linkTitle,
            'read' => 0,
        ];
        storeNotification($notification_data);
    }
}

/**
 * @param $data
 * @return void
 */
function storeEteamLog($data): void
{
    ETeamLog::create([
        'eteam_id' => $data['eteam_id'],
        'message' => $data['message'],
    ]);
}

/**
 * @param $data
 * @return void
 */
function storeEteamPost($data): void
{
    ETeamPost::create([
        'eteam_id' => $data['eteam_id'],
        'user_id' => $data['user_id'],
        'title' => $data['title'],
        'content' => $data['content'],
        'public' => $data['public'] ?? true,
        'slug' => Str::slug($data['title'], '-')
    ]);
}
