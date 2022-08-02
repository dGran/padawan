<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Admin;

use App\Models\ETeam;
use Livewire\Component;

class Profile extends Component
{
    public $eteam;

    protected $queryString = [
        'order' => ['except' => 'created_at_desc']
    ];

    public function mount(Eteam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        return view('eteam.admin.profile.index');
    }
}
