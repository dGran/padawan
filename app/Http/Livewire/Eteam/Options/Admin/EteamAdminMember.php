<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Http\Managers\EteamMemberManager;
use App\Models\ETeam;
use App\Models\ETeamUser;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class EteamAdminMember extends Component
{
    public ETeam $eteam;
    public User $user;
    public array $data = [];
    public string $searchFilter = '';
    public string $rangeFilter = 'all';
    public bool $someFilterApplied = false;
    public string $order = "created_at_desc";

    protected $listeners = ['updateRange'];

    protected $queryString = [
        'order' => ['except' => 'created_at_desc', 'as' => 'o'],
        'searchFilter' => ['except' => '', 'as' => 's'],
        'rangeFilter' => ['except' => 'all', 'as' => 'r']
    ];

    // dependency injections
    public function getEteamMemberManagerProperty(): EteamMemberManager
    {
        return resolve(EteamMemberManager::class);
    }

    public function mount(Eteam $eteam, User $user): void
    {
        $this->eteam = $eteam;
        $this->user = $user;
        $this->data['name'] = 'miembros';
    }

    public function render(): View
    {
        $members = $this->getData();
        $this->data['class'] = $members;
        $this->someFilterApplied = $this->someFilterApplied();

        return view('eteam.admin.members.index');
    }

    /**
     * @return array<EteamUser>
     */
    protected function getData()
    {
        $query = ETeamUser::select('eteams_users.*', 'users.name as username')
            ->join('users', 'users.id', 'eteams_users.user_id')
            ->where('eteam_id', $this->eteam->id)
            ->search($this->searchFilter)
            ->range($this->rangeFilter);

        if ($this->getOrder()['field'] === 'captain') {
            $query = $query->orderBy('owner', $this->getOrder()['direction']);
        }

        return $query->orderBy($this->getOrder()['field'], $this->getOrder()['direction'])
            ->get();
    }

    protected function someFilterApplied(): bool
    {
        return !empty($this->searchFilter) || ($this->rangeFilter !== 'all');
    }

    public function setRangeFilter(string $range): void
    {
        $this->rangeFilter = $range;
    }

    public function clearFilter(string $filter): void {
        $this->reset($filter);

        if ($filter === 'searchFilter') {
            $this->emit('focus-search');
        }
    }

    public function setOrder(string $value): void
    {
        $this->order = $value;
    }

    protected function getOrder(): array
    {
        $orderValues = EteamMemberManager::ORDER_VALUES;

        return $orderValues[$this->order];
    }

    public function transferTeamOwnership(int $userId): void
    {
        $transferTeamOwnership = $this->eteamMemberManager->transferTeamOwnership($this->eteam->id, $this->user->id, $userId);

        if ($transferTeamOwnership) {
            // falta el modal de confirmación
            // guardar en el log
            // crear noticia privada
            // enviar mails a todos los miembros
            $this->dispatchBrowserEvent('action-success', ['message' => 'Has transferido la propiedad del equipo correctamente.']);

            return;
        }

        $this->dispatchBrowserEvent('action-error', ['message' => 'Ha habido un problema durante el proceso.']);
    }

    public function grantCaptainRange(int $eteamMemberId): void
    {
        if ($this->eteamMemberExists($eteamMemberId)) {
            $this->emit("openModal", "eteam.options.admin.eteam-admin-member-grant-captain-range-modal", ['eteamMemberId' => $eteamMemberId]);
        }
    }

    public function removeCaptainRange(int $eteamMemberId): void
    {
        if ($this->eteamMemberExists($eteamMemberId)) {
            $this->emit("openModal", "eteam.options.admin.eteam-admin-member-remove-captain-range-modal", ['eteamMemberId' => $eteamMemberId]);
        }
    }

    public function updateRange(EteamUser $eteamMember, string $range): void
    {
        $eteamId = $this->eteam->id;
        $userId = $eteamMember->user_id;

        try {
            $this->eteamMemberManager->updateCaptainRange($eteamId, $userId, $range);
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('action-error', ['message' => 'Ha habido un problema durante el proceso.']);

            return;
        }

        if ($range === 'captain') {
            $message = "Has otorgado el rango de capitán correctamente.";
        } else {
            $message = "Has retirado el rango de capitán correctamente.";
        }

        $this->dispatchBrowserEvent('action-success', ['message' => $message]);
    }

    protected function eteamMemberExists(int $eteamMemberId): bool {
        $eteamMember = ETeamUser::find($eteamMemberId);

        if (!$eteamMember) {
            $this->dispatchBrowserEvent('action-error', ['message' => EteamMemberManager::REG_NOT_EXISTS]);

            return false;
        }

        return true;
    }
}
