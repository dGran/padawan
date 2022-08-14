<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Services\EteamPostService;
use App\Models\ETeamPost;
use Illuminate\Support\Str;

class EteamPostManager
{
    public const ORDER_VALUES = [
        'id' => [
            'field' => 'id',
            'direction' => 'asc',
        ],
        'id_desc' => [
            'field' => 'id',
            'direction' => 'desc',
        ],
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
    public const STORED_MESSAGE = 'Noticia creada correctamente';
    public const STORE_FAILS_MESSAGE = 'Se ha producido un error al crear la noticia';
    public const REG_NOT_EXISTS = 'La noticia ya no existe';

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
        $this->eteamLogManager->createEteamPostCreateLog($data);
    }

    public function update(array $data, array $logData): void
    {
        $eteamPost = ETeamPost::find($data['id']);

        if ($eteamPost) {
            $eteamPost->fill($data);
            $eteamPost->slug = '#'.$data['id'].'-'.Str::slug($data['title'], '-');
            $eteamPost->update();
            $this->eteamLogManager->createEteamPostUpdateLog($logData);
        }
    }

    public function delete(int $eteamPostId, array $logData): void
    {
        $eteamPost = ETeamPost::find($eteamPostId);

        if ($eteamPost) {
            $eteamPost->delete();
            $this->eteamLogManager->createEteamPostDeleteLog($logData);
        }
    }
}
