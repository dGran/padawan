<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\EteamMemberService;

class EteamMemberManager
{
    public const ORDER_VALUES = [
        'user' => [
            'field' => 'users.name',
            'direction' => 'asc',
        ],
        'user_desc' => [
            'field' => 'users.name',
            'direction' => 'desc',
        ],
        'range' => [
            'field' => 'captain',
            'direction' => 'asc',
        ],
        'range_desc' => [
            'field' => 'captain',
            'direction' => 'desc',
        ],
        'created_at' => [
            'field' => 'created_at',
            'direction' => 'asc',
        ],
        'created_at_desc' => [
            'field' => 'created_at',
            'direction' => 'desc',
        ]
    ];

    private EteamMemberService $eteamMemberService;

    public function __construct(EteamMemberService $eteamMemberService)
    {
        $this->eteamMemberService = $eteamMemberService;
    }
}
