<?php

namespace App\Http\Livewire\Eteam\Options\Admin;

use App\Models\ETeam;
use App\Models\ETeamInvitation;
use App\Models\ETeamUser;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class EteamAdminManagementNewInvitationModal extends ModalComponent
{
    use WithPagination;

    protected const GAME_GT = 1;
    protected const PAGINATOR_DEFAULT = 8;

    private ETeam $eteam;

    public function mount(ETeam $eteam)
    {
        $this->eteam = $eteam;
    }

    public function render()
    {
        $availableUsers = $this->getAvailableUsers();

        return view('modals.eteams.management-new-invitation-modal',
            [
                'availableUsers' => $availableUsers
            ]
        );
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function sendInvitation(User $user): void
    {
        $this->emit('closeModal');
        $this->emit('sendInvitation', $user);
    }

    protected function getAvailableUsers(): LengthAwarePaginator
    {
        $subqueryNotInOtherEteamSameGame = ETeamUser::join('eteams', 'eteams.id', '=', 'eteams_users.eteam_id')
            ->where('eteams.game_id', self::GAME_GT)
            ->where('eteams_users.active', 1)
            ->pluck('eteams_users.id')->toArray();

//        $eteamId = $this->eteam->id;
//        $subqueryNotInvitation = ETeamInvitation::
//            where('eteam_id', $eteamId)
//            ->pluck('user_id')->toArray();

        $result = User::select('*')
            ->whereNotIn('users.id', $subqueryNotInOtherEteamSameGame)
//            ->whereNotIn('users.id', $subqueryNotInvitation)
            ->orderBy('users.name', 'asc')
            ->paginate(self::PAGINATOR_DEFAULT);

        return $result;
    }

    public function setCurrentPage(): void
    {
        $this->gotoPage($this->page);
    }

    public function toPage($page): void
    {
        $this->gotoPage($page);
    }

    public function nextPage(int $lastPage): void
    {
        if (($this->page + 1) <= $lastPage) {
            $this->setPage($this->page + 1);
        } else {
            $this->setPage(1);
        }
    }

    public function previousPage(int $lastPage): void
    {
        if ($this->page > 1) {
            $this->setPage($this->page - 1);
        } else {
            $this->setPage($lastPage);
        }
    }
}
