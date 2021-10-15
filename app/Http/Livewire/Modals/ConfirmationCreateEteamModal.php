<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamUser;
use Livewire\WithFileUploads;

class ConfirmationCreateEteamModal extends ModalComponent
{
    use WithFileUploads;

    public $data;

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('eteams.create.confirmation-modal');
    }

    public function store()
    {
        $eteam = Team_Esport::create($this->data);

        $eteamUser = ETeamUser::create([
            'eteam_id' => $eteam->id,
            'user_id' => $this->data['user_id'],
            'owner' => true,
            'captain' => true,
        ]);

        return redirect()->route('eteams.eteam', $eteam->slug);
    }

    public static function modalMaxWidth(): string
    {
        // 'sm'
        // 'md'
        // 'lg'
        // 'xl'
        // '2xl'
        // '3xl'
        // '4xl'
        // '5xl'
        // '6xl'
        // '7xl'
        return 'sm';
    }
}
