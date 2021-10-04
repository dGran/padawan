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
    public $user, $users, $games, $countries;

    public $game_selected, $gameFilterName;
    public $country_selected, $countryFilterName;

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

    public function changeGame($id)
    {
        if ($id) {
            $this->game_selected = Game::find($id);
            if ($this->game_selected) {
                $this->game_id = $this->game_selected->id;
                $this->gameFilterName = null;
            } else {
                $this->game_id = null;
            }
        } else {
            $this->game_id = null;
        }
    }

    public function filterGames()
    {
        $this->games = Game::name($this->gameFilterName)->where('allow_eteams', true)->orderBy('name', 'asc')->get();
    }

    public function changeCountry($id)
    {
        if ($id) {
            $this->country_selected = Country::find($id);
            if ($this->country_selected) {
                $this->country_id = $this->country_selected->id;
                $this->countryFilterName = null;
            } else {
                $this->country_id = null;
            }
        } else {
            $this->country_id = null;
        }
    }

    public function filterCountries()
    {
        $this->countries = Country::name($this->countryFilterName)->orderBy('name', 'asc')->get();
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
        return view('eteams.create')
            ->layout('layouts.app', ['title' => 'Nuevo equipo', 'breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

}