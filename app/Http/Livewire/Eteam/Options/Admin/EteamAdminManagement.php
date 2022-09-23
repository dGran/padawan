<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Http\Managers\EteamManagementManager;
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

    protected $listeners = ['sendInvitation'];

    // dependency injections
    public function getEteamManagemetManagerProperty(): EteamManagementManager
    {
        return resolve(EteamManagementManager::class);
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

    public function openInvitationModal(): void
    {
        $this->emit("openModal", "eteam.options.admin.eteam-admin-management-new-invitation-modal", ['eteam' => $this->eteam]);
    }

    public function sendInvitation(User $user): void
    {
        try {
            $this->eteamManagemetManager->sendInvitation($this->eteam, $this->user, $user);
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => 'Ha habido un problema durante el proceso.']);

            return;
        }

        $this->dispatchBrowserEvent('action-success', ['message' => 'Has enviado la invitación correctamente.']);
    }
}
