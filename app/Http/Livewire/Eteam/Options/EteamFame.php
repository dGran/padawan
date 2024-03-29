<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options;

use App\Models\ETeam;
use Livewire\Component;

class EteamFame extends Component
{
    public $eteam;

    public function mount(Eteam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        return view('eteam.fame.index');
    }
}
