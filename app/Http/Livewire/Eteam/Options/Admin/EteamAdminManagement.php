<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Http\Managers\EteamMemberManager;
use App\Models\ETeam;
use App\Models\ETeamInvitation;
use App\Models\ETeamRequest;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class EteamAdminManagement extends Component
{
    public ETeam $eteam;
    public User $user;

    protected $listeners = [];

    // dependency injections
    public function getEteamMemberManagerProperty(): EteamMemberManager
    {
        return resolve(EteamMemberManager::class);
    }

    public function mount(Eteam $eteam, User $user): void
    {
        $this->eteam = $eteam;
        $this->user = $user;
    }

    public function render(): View
    {
        $invitations = $this->getInvitations();
        $requests = $this->getRequests();

        return view('eteam.admin.management.index', [
            'invitations' => $invitations,
            'requests' => $requests
        ]);
    }

    /**
     * @return array<ETeamInvitation>
     */
    protected function getInvitations()
    {
        return ETeamInvitation::select('eteams_invitations.*')
            ->where('eteam_id', $this->eteam->id)
            ->where('state', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @return array<ETeamRequest>
     */
    protected function getRequests()
    {
        return ETeamRequest::select('eteams_requests.*')
            ->where('eteam_id', $this->eteam->id)
            ->where('state', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
