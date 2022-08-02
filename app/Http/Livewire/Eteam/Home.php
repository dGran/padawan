<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam;

use App\Models\ETeam;
use Livewire\Component;

class Home extends Component
{
    public $eteam;

    public function mount(Eteam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        return view('eteam.home.index');
    }
}
