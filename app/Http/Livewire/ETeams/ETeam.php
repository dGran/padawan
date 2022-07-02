<?php

namespace App\Http\Livewire\ETeams;

use App\Models\User;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamRequest;
use App\Models\ETeamPost;
use App\Models\ETeamUser;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ETeam extends Component
{
    use WithPagination;

    public $op = "sede", $admin_op;

    public $eteam;
    public $game_id, $name, $short_name, $logo, $country_id, $location, $presentation, $presentation_video, $website, $whatsapp, $facebook, $instagram, $twitter, $twitch, $youtube;
    public $members, $membersFilter = 'all';

    protected $queryString = [
        'op',
        'admin_op' => ['except' => ''],
    ];

    public function RequestJoin($eteam_id): void
    {
        if (Auth::check()) {

            $eteam = Team_Esport::find($eteam_id);
            $user = User::find(Auth::user()->id);

            $request = ETeamRequest::create([
                'eteam_id' => $eteam_id,
                'user_id' => $user->id,
                'state' => 'pending',
                'message' => 'Hola, quiero unirme a vuestro equipo, gracias.'
            ]);

            foreach ($eteam->getCaptains() as $captain) {
                //send notification with helper
                $content = "$user->name ha enviado solicitud de ingreso en tu equipo";
                if ($request->message) {
                    $content .= " y ha dejado el siguiente mensaje:</br></br>\"$request->message\"";
                } else {
                    $content .= ".";
                }
                $content .= "</br></br>Como capitán puedes aceptar y rechazar la solicitud de ingreso.";

                $notification_data = [
                    'user_id' => $captain->user_id,
                    'title' => "$user->name ha solicitado el ingreso en tu equipo '$eteam->name'",
                    'content' => $content,
                    'link' => Route('myteams'),
                    'link_title' => 'Mis equipos',
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
                    'title' => "Retirada de solicitud de ingreso en tu equipo '$eteam->name'",
                    'content' => "$user->name ha retirado la solicitado de ingreso en tu equipo. </br> Puedes acceder desde el enlace",
                    'link' => Route('eteams.eteam', $eteam->slug),
                    'read' => 0
                ];
                storeNotification($notification_data);
            }
        }
    }

    public function checkTabs($op, $admin_op)
    {
        if (!$op) {
            $op = 'sede';
        } else {
            if ($op == 'admin') {
                if (auth()->user() && auth()->user()->isAdminETeam($this->eteam->id)) {
                    if (!$admin_op) {
                        $this->admin_op = 'perfil';
                    }
                } else {
                    session()->flash('error', 'No estás autorizado.');
                    $this->op = 'sede';
                    $this->admin_op = null;
                }
            } else {
                $this->admin_op = '';
            }
        }
    }

    public function changeTab($tab)
    {
        $this->op = $tab;
    }

    public function changeAdminTab($tab)
    {
        $this->admin_op = $tab;
    }

    public function changeMembersFilter($filter)
    {
        $this->membersFilter = $filter;
    }

    public function loadPostsData()
    {
        return $posts = ETeamPost::where('eteam_id', $this->eteam->id)->orderBy('created_at', 'desc')->paginate(5);
    }

    public function loadMembersData()
    {
        if ($this->membersFilter == 'all') {
            $this->members = $this->eteam->users;
        } else {
            $this->members = ETeamUser::where('eteam_id', $this->eteam->id)->where('captain', true)->get();
        }

    }

    public function loadFameData()
    {

    }

    public function loadAdminData($op)
    {
        switch ($this->op) {
            case 'profile':
                $this->loadAdminProfileData();
                break;
            case 'posts':
                $this->loadAdminPostsData();
                break;
            case 'members':
                $this->loadAdminMembersData();
                break;
        }
    }

    public function loadAdminProfileData()
    {

    }

    public function loadAdminPostsData()
    {

    }

    public function loadAdminMembersData()
    {

    }

    public function mount()
    {
        if (request()->op) { $this->op = request()->op; }
        if (request()->admin_op) {
            $this->op = 'admin';
            $this->admin_op = request()->admin_op;
        }
        $this->eteam = Team_Esport::where('slug', request()->slug)->first();
    }

    public function render()
    {
        $this->checkTabs($this->op, $this->admin_op);

        $posts = [];
        switch ($this->op) {
            case 'noticias':
                $posts = $this->loadPostsData();
                break;
            case 'miembros':
                $this->loadMembersData();
                break;
            case 'palmares':
                $this->loadFameData();
                break;
            case 'admin':
                $this->loadAdminData($this->admin_op);
                break;
            default:
                $this->op = 'sede';
                break;
        }

        return view('eteams.eteam', [
                'posts' => $posts
            ])
            ->layout('layouts.app', ['title' => $this->eteam->name, 'breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }
}
