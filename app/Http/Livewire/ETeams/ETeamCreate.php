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
use Illuminate\Support\Facades\Storage;

class ETeamCreate extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $step2_disabled = true, $step3_disabled = true, $step4_disabled = true;

    public $user, $users, $games, $countries;

    public $game_id, $name, $short_name, $logo, $banner, $country_id, $member_requests = true, $location, $presentation, $presentation_video, $website, $whatsapp, $facebook, $instagram, $twitter, $twitch, $youtube;

    public $name_available, $short_name_available;
    public $banner_preview, $logo_preview;

    public $data;

    public function changeStep($current, $next)
    {
        $this->step = $current;
        if ($next) {
            $this->step++;
        } else {
            $this->step--;
        }

        switch ($this->step) {
            case 2:
                $this->emit('focus-step-2');
                break;
            case 3:
                $this->emit('focus-step-3');
                break;
            case 4:
                $this->emit('focus-step-4');
                break;
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
            'banner' => 'mimes:jpeg,png,jpg,gif,svg|max:1024'
        ],
        [
            'banner.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
            'banner.max' => 'El tamaño de la imagen no puede ser mayor a 1024 bytes',
        ]);
    }

    public function deleteBanner()
    {
        $this->reset('banner');
        $this->resetValidation('banner');
        $this->selectGame($this->game_id);
    }

    public function uploadLogo()
    {
        $this->validate([
            'logo' => 'mimes:jpeg,png,jpg,gif,svg|max:1024'
        ],
        [
            'logo.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
            'logo.max' => 'El tamaño de la imagen no puede ser mayor a 1024 bytes',
        ]);
    }

    public function deleteLogo()
    {
        $this->reset('logo');
        $this->resetValidation('logo');
        $this->selectGame($this->game_id);
    }

    public function store()
    {
        $logo = null;
        if ($this->logo) {
            $this->validate([
                'logo' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
            ],
            [
                'logo.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'logo.max' => 'El tamaño de la imagen no puede ser mayor a 1024 bytes',
            ]);
            $fileName = Str::slug($this->name, '-') . '.' . $this->logo->extension();
            $logo = $this->logo->storeAs('eteams/logos', $fileName, 'public');
        }

        $banner = null;
        if ($this->banner) {
            $this->validate([
                'banner' => 'mimes:jpeg,png,jpg,gif,svg|max:1024',
            ],
            [
                'banner.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'banner.max' => 'El tamaño de la imagen no puede ser mayor a 1024 bytes',
            ]);
            $fileName = Str::slug($this->name, '-') . '.' . $this->banner->extension();
            $banner = $this->banner->storeAs('eteams/banners', $fileName, 'public');
        }

        $eteam = Team_Esport::create([
            'game_id' => $this->game_id,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'logo' => $logo,
            'banner' => $banner,
            'country_id' => $this->country_id,
            'location' => $this->location,
            'member_requests' => $this->member_requests ? 1 : 0,
            'presentation' => $this->presentation,
            'presentation_video' => $this->presentation_video,
            'website' => $this->website,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'twitch' => $this->twitch,
            'youtube' => $this->youtube,
            'slug' => Str::slug($this->name, '-'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        ETeamUser::create([
            'eteam_id' => $eteam->id,
            'user_id' => $this->user->id,
            'owner' => true,
            'captain' => true,
        ]);

        //send notification with helper
        $notification_data = [
            'user_id' => $this->user->id,
            'from_user_id' => null,
            'title' => "Equipo '$eteam->name' creado",
            'content' => 'Tu equipo se ha creado correctamente. Eres el propietario y único capitán del equipo pero puedes ascender a capitán a otros futuros miembros.',
            'link' => Route('eteams.eteam', $eteam->slug),
            'link_title' => $eteam->name,
            'read' => 0
        ];
        storeNotification($notification_data);

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