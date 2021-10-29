<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamUser;

class ETeam extends Component
{
    public $op = "sede", $admin_op;

    public $eteam;
    public $game_id, $name, $short_name, $logo, $country_id, $location, $presentation, $presentation_video, $website, $whatsapp, $facebook, $instagram, $twitter, $twitch, $youtube;
    public $members, $membersFilter = 'all';

    protected $queryString = [
        'op',
        'admin_op' => ['except' => ''],
    ];

    public function checkTabs($op, $admin_op)
    {
        if (!$op) {
            $op = 'sede';
        } else {
            if ($op == 'admin') {
                if (auth()->user()->isAdminETeam($this->eteam->id)) {
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

        switch ($this->op) {
            case 'noticias':
                $this->loadPostsData();
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
        }

        return view('eteams.eteam')
            ->layout('layouts.app', ['title' => 'Equipos', 'breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

}