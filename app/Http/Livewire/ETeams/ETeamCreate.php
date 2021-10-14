<?php

namespace App\Http\Livewire\ETeams;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamUser;
use App\Models\User;
use App\Models\Game;
use App\Models\Country;
use Livewire\WithFileUploads;

class ETeamCreate extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $step2_disabled = true, $step3_disabled = true, $step4_disabled = true;

    public $user, $users, $games, $countries;

    public $game_id, $name, $short_name, $logo, $banner, $country_id, $location, $presentation, $presentation_video, $website, $whatsapp, $facebook, $instagram, $twitter, $twitch, $youtube;

    public $name_available, $short_name_available;
    public $banner_preview, $logo_preview;

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

    public function checkSteps()
    {
        if (!$this->game_id) {
            $this->step2_disabled = true;
        } else {
            $this->step2_disabled = false;
        }

        if (!$this->name || !$this->short_name || !$this->checkName() || !$this->checkShortName()) {
            $this->step3_disabled = true;
        } else {
            if (!$this->step2_disabled) {
                $this->step3_disabled = false;
            } else {
                $this->step3_disabled = true;
            }
        }

        if (!$this->step3_disabled) {
            $this->step4_disabled = false;
        } else {
            $this->step4_disabled = true;
        }
    }

    public function selectGame($id)
    {
        $game = Game::find($id);
        if ($game) {
            $this->game_id = $game->id;
            if (!$this->banner) {
                $this->banner_preview = $game->getBanner();
            }
            if (!$this->logo) {
                $this->logo_preview = $game->getLogo();
            }
        }
    }

    public function checkName()
    {
        $matches = Team_Esport::where('name', $this->name)->count();
        if (!$matches) {
            $this->name_available = true;
            return true;
        }
        $this->name_available = false;
        return false;
    }

    public function checkShortName()
    {
        $matches = Team_Esport::where('short_name', $this->short_name)->count();
        if (!$matches) {
            $this->short_name_available = true;
            return true;
        }
        $this->short_name_available = false;
        return false;
    }

    public function transformShortName()
    {
        $this->short_name = strtoupper($this->short_name);
    }

    public function uploadBanner()
    {
        $this->validate([
            'logo' => 'image|max:1024', // 1MB Max
        ]);

        $this->banner_preview = $this->banner;
    }

    public function deleteBanner()
    {
        $this->banner = null;
        $this->selectGame($this->game_id);
    }

    public function uploadLogo()
    {
        $this->validate([
            'logo' => 'image|max:1024', // 1MB Max
        ]);

        $this->logo_preview = $this->logo;
    }

    public function deleteLogo()
    {
        $this->logo = null;
        $this->selectGame($this->game_id);
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

    public function mount()
    {
        $this->user = auth()->user();
        $this->users = User::orderBy('name', 'asc')->get();
        $this->games = Game::where('allow_eteams', true)->orderBy('name', 'asc')->get();
        $this->countries = Country::orderBy('name', 'asc')->get();
    }

    public function render()
    {
        $this->checkSteps();

        return view('eteams.create')
            ->layout('layouts.app', ['title' => 'Nuevo equipo', 'breadcrumb' => 1, 'wfooter' => 0, 'wloader' => 0]);
    }

}