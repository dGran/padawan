<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Admin;

use App\Models\ETeam;
use Livewire\Component;

class Profile extends Component
{
    public $eteam;

    public function mount(Eteam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        return view('eteam.admin.profile.index');
    }
}
