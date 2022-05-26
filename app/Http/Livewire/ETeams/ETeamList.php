<?php

namespace App\Http\Livewire\ETeams;

use App\Models\ETeam as Team_Esport;
use App\Models\ETeamRequest;
use App\Models\ETeamUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Auth;

class ETeamList extends Component
{
    use WithPagination;

    public $order="created_at_desc";
    public $view="table";
    public $search;
    public $game;
    
    protected $queryString = [
        'order' => ['except' => 'created_at_desc'],
        'view' => ['except' => 'table'],
        'search' => ['except' => ''],
        'game' => ['except' => ''],
    ];

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

    protected function getOrder($order): array
    {
        (array)$orderValue = [
            'name' => [
                'field'     => 'name',
                'direction' => 'asc'
            ],
            'name_desc' => [
                'field'     => 'name',
                'direction' => 'desc'
            ],
            'members' => [
                'field'     => 'users_count',
                'direction' => 'asc'
            ],
            'members_desc' => [
                'field'     => 'users_count',
                'direction' => 'desc'
            ],
            'game' => [
                'field'     => 'games.name',
                'direction' => 'asc'
            ],
            'game_desc' => [
                'field'     => 'games.name',
                'direction' => 'desc'
            ],
            'location' => [
                'field'     => 'location',
                'direction' => 'asc'
            ],
            'location_desc' => [
                'field'     => 'location',
                'direction' => 'desc'
            ],
            'created_at' => [
                'field'     => 'created_at',
                'direction' => 'asc'
            ],
            'created_at_desc' => [
                'field'     => 'created_at',
                'direction' => 'desc'
            ]
        ];

        return $orderValue[$order];
    }

    public function toggleView()
    {
        if ($this->view == 'table') {
            $this->view = 'card';
        } else {
            $this->view = 'table';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingGame()
    {
        $this->resetPage();
    }

    public function RequestJoin($eteam_id): void
    {
        if (Auth::check()) {

            $eteam = Team_Esport::find($eteam_id);
            $user = User::find(Auth::user()->id);

            ETeamRequest::create([
                'eteam_id' => $eteam_id,
                'user_id' => $user->id,
                'state' => 'pending',
                'message' => 'Hola, quiero unirme a vuestro equipo, gracias.'
            ]);
    
            foreach ($eteam->getCaptains() as $captain) {
                //send notification with helper
                $notification_data = [
                    'user_id' => $captain->user_id,
                    'from_user_id' => null,
                    'title' => "Nueva solicitud de ingreso en tu equipo '$eteam->name'",
                    'content' => "$user->name ha solicitado el ingreso en tu equipo. </br> Puedes acceder desde el enlace",
                    'link' => Route('eteams.eteam', $eteam->slug),
                    'read' => 0
                ];
                storeNotification($notification_data);
            }
        }
    }

    public function CancelRequestJoin($eteam_id): void
    {
        if (Auth::check()) {

            $eteam = Team_Esport::find($eteam_id);
            $user = User::find(Auth::user()->id);

            $eteamRequests = ETeamRequest::where('eteam_id', $eteam_id)->where('user_id', $user->id)->get();
            foreach ($eteamRequests as $request) {
                $request->delete();
            }
               
            foreach ($eteam->getCaptains() as $captain) {
                //send notification with helper
                $notification_data = [
                    'user_id' => $captain->user_id,
                    'from_user_id' => null,
                    'title' => "Retirada de solicitud de ingreso en tu equipo '$eteam->name'",
                    'content' => "$user->name ha retirado la solicitado de ingreso en tu equipo. </br> Puedes acceder desde el enlace",
                    'link' => Route('eteams.eteam', $eteam->slug),
                    'read' => 0
                ];
                storeNotification($notification_data);
            }
        }
    }

    public function getMyEteams()
    {
        if (Auth::check()) {

            return Team_Esport::
                leftJoin('games', 'games.id', 'eteams.game_id')
                ->leftJoin('eteams_users', 'eteams_users.eteam_id', 'eteams.id')
                ->select('eteams.*')
                ->where('eteams_users.user_id', auth()->user()->id)
                ->orderBy('name', 'asc')
                ->get();
        }

        return false;
    }

    public function getEteams()
    {
        return Team_Esport::
            withCount('users')
            ->leftJoin('games', 'games.id', 'eteams.game_id')
            ->search($this->search)
            ->game($this->game)
            ->orderBy($this->getOrder($this->order)['field'], $this->getOrder($this->order)['direction'])
            ->orderBy('name', 'asc')            
            ->paginate(15);
    }

    public function render()
    {
        $etGames = Team_Esport::leftJoin('games', 'games.id', 'eteams.game_id')
            ->select('eteams.game_id', 'games.name')
            ->distinct()
            ->orderBy('games.name', 'asc')
            ->get();

        return view('eteams.list',
            [
                'eteams'     => $this->getEteams(),
                'my_eteams'  => $this->getMyEteams(),
                'etGames'    => $etGames
            ]
        )->layout('layouts.app',
            [
                'title'      => 'Equipos',
                'breadcrumb' => 0,
                'wfooter'    => 0,
                'wloader'    => 0
            ]
        );
    }

}