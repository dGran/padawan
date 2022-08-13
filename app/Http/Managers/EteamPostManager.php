<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\EteamPostService;
use App\Models\ETeamPost;
use Illuminate\Support\Str;

class EteamPostManager
{
    public const ORDER_VALUES = [
        'user' => [
            'field' => 'username',
            'direction' => 'asc',
        ],
        'user_desc' => [
            'field' => 'username',
            'direction' => 'desc',
        ],
        'visibility' => [
            'field' => 'public',
            'direction' => 'asc',
        ],
        'visibility_desc' => [
            'field' => 'public',
            'direction' => 'desc',
        ],
        'title' => [
            'field' => 'title',
            'direction' => 'asc',
        ],
        'title_desc' => [
            'field' => 'title',
            'direction' => 'desc',
        ],
        'content' => [
            'field' => 'content',
            'direction' => 'asc',
        ],
        'content_desc' => [
            'field' => 'content',
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

    public const UPDATED_MESSAGE = 'Cambios guardados correctamente';
    public const UPDATE_FAILS_MESSAGE = 'Se ha producido un error al guardar la noticia';
    public const UPDATE_NO_DIRTY_MESSAGE = 'No se han detectado cambios';
    public const REG_NOT_EXISTS = 'El registro ya no existe';

    private EteamPostService $eteamPostService;
    private EteamLogManager $eteamLogManager;

    public function __construct
    (
        EteamPostService $eteamPostService,
        EteamLogManager $eteamLogManager
    ) {
        $this->eteamPostService = $eteamPostService;
        $this->eteamLogManager = $eteamLogManager;
    }

    public function create(array $data): void
    {
        ETeamPost::create($this->eteamPostService->getCreateData($data));
        $this->eteamLogManager->createEteamPostLog($data);
    }

    public function delete(EteamPost $eteamPost): void
    {
        $eteamPost->delete();
    }

    public function update(EteamPost $eteamPost, array $data): void
    {
        $eteamPost->title = $data['title'];
        $eteamPost->content = $data['content'];
        $eteamPost->public = $data['public'];
        $eteamPost->slug = Str::slug($data['title'], '-');

        $eteamPost->update();
    }
}
