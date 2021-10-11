<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamUser;
use App\Models\User;
use App\Models\Game;
use App\Models\Country;

class ETeamCreate extends Component
{

    public $step = 1;
    public $user, $users, $games, $countries;

    public $formDisabled;
    public $game_id, $name, $short_name, $logo, $country_id, $location, $presentation, $presentation_video, $website, $whatsapp, $facebook, $instagram, $twitter, $twitch, $youtube;

    public function initialize()
    {
        $game_id = null;
        $name = null;
        $short_name = null;
        $logo = null;
        $country_id = null;
        $location = null;
        $presentation = null;
        $presentation_video = null;
        $website = null;
        $whatsapp = null;
        $facebook = null;
        $instagram = null;
        $twitter = null;
        $twitch = null;
        $youtube = null;
    }

    public function changeStep($current, $next)
    {
        $this->step = $current;
        if ($next) {
            $this->step++;
        } else {
            $this->step--;
        }
    }

    public function selectGame($id)
    {
        $this->game_id = $id;
    }

    public function store()
    {
        $eteam = Team_Esport::create([
            'game_id' => $this->game_id,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'country_id' => $this->country_id,
            'location' => $this->location,
            'presentation' => $this->presentation,
            'presentation_video' => $this->presentation_video,
            'website' => $this->website,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'twitch' => $this->twitch,
            'youtube' => $this->youtube,
            'created_at' => now(),
            'updated_at' => now(),
            'slug' => Str::slug($this->name, '-'),
        ]);

        $eteamUser = ETeamUser::create([
            'eteam_id' => $eteam->id,
            'user_id' => $this->user->id,
            'owner' => true,
            'captain' => true,
        ]);

        return redirect()->route('eteams.eteam', $eteam->slug);
    }

    public function transformShortName()
    {
        $this->short_name = strtoupper($this->short_name);
    }

    public function checkForm()
    {
        if (!$this->game_id || !$this->name || !$this->short_name) {
            $this->formDisabled = true;
        } else {
            $this->formDisabled = false;
        }
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->users = User::orderBy('name', 'asc')->get();
        $this->games = Game::where('allow_eteams', true)->orderBy('name', 'asc')->get();
        $this->countries = Country::orderBy('name', 'asc')->get();
    }

    public function render()
    {
        $this->checkForm();

        return view('eteams.create')
            ->layout('layouts.app', ['title' => 'Nuevo equipo', 'breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

}