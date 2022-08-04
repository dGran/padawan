<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options;

use App\Models\ETeam;
use App\Models\ETeamPost;
use Livewire\Component;

class EteamPost extends Component
{
    public $eteam;
    public $order = "created_at_desc";

    protected $queryString = [
        'order' => ['except' => 'created_at_desc']
    ];

    public function mount(Eteam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        $posts = $this->getData();

        return view('eteam.posts.index', [
            'posts' => $posts
        ]);
    }

    protected function getData()
    {
        return ETeamPost::select('eteams_posts.*', 'users.name as username')
            ->join('users', 'users.id', 'eteams_posts.user_id')
            ->where('eteam_id', $this->eteam->id)
            ->orderBy($this->getOrder()['field'], $this->getOrder()['direction'])
            ->paginate(15);
    }

    public function setCurrentPage()
    {
        $this->gotoPage($this->page);
    }

    public function toPage($page)
    {
        $this->gotoPage($page);
    }

    public function nextPage($lastPage)
    {
        if (($this->page + 1) <= $lastPage) {
            $this->setPage($this->page + 1);
        } else {
            $this->setPage(1);
        }
    }

    public function previousPage($lastPage)
    {
        if ($this->page > 1) {
            $this->setPage($this->page - 1);
        } else {
            $this->setPage($lastPage);
        }
    }

    public function setOrder(string $value)
    {
        $this->order = $value;
    }

    protected function getOrder(): array
    {
        (array) $orderValue = [
            'user' => [
                'field' => 'username',
                'direction' => 'asc',
            ],
            'user_desc' => [
                'field' => 'username',
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

        return $orderValue[$this->order];
    }
}
