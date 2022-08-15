<?php

declare(strict_types=1);

namespace App\Http\Livewire\Eteam;

use App\Models\ETeam as EteamModel;
use Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\RedirectResponse;

class Eteam extends Component
{
    use WithPagination;

    protected const AVAILABLE_TABS = [
        'sede',
        'noticias',
        'miembros',
        'multimedia',
        'palmmares',
        'admin'
    ];
    protected const AVAILABLE_ADMIN_TABS = [
        'perfil',
        'noticias',
        'miembros',
        'multimedia',
        'log'
    ];

    public ?string $tab = "sede";
    public ?string $adminTab = null;
    public EteamModel $eteam;

    protected $queryString = [
        'tab' => ['except' => '', 'as' => 'op'],
        'adminTab' => ['except' => '', 'as' => 'ad']
    ];

    /**
     * @return RedirectResponse|void
     */
    public function mount(string $slug)
    {
        $this->eteam = EteamModel::where('slug', $slug)->first();

        if (empty($this->eteam)) {
            return redirect()->route('eteams')->with('error', 'No existe el equipo '.$slug);
        }

        $this->checkTabs($this->tab, $this->adminTab);
    }

    public function render(): View
    {
        return view('eteam.index')
            ->layout('layouts.app',
                [
                    'title' => $this->eteam->name,
                    'breadcrumb' => 1,
                    'wfooter' => 0,
                    'wloader' => 0
                ]
            );
    }

    public function changeTab(string $tab): void
    {
        $this->tab = $tab;
        $this->checkTabs($this->tab, $this->adminTab);
    }

    public function changeAdminTab(string $tab): void
    {
        $this->adminTab = $tab;
        $this->checkTabs($this->tab, $this->adminTab);
    }

    public function checkTabs(?string $tab, ?string $adminTab): void
    {
        if (!in_array($tab, self::AVAILABLE_TABS, true)) {
            session()->flash('warning', 'Opción no disponible.');
            $this->setTabs('sede', (string) null);

            return;
        }

        if ($tab === 'admin') {
            if (!auth()->user()) {
                session()->flash('error', 'Debes iniciar sesión.');
                $this->setTabs('sede', (string) null);

                return;
            }

            if (!auth()->user()->isAdminETeam($this->eteam->id)) {
                session()->flash('error', 'No estás autorizado.');
                $this->setTabs('sede', (string) null);

                return;
            }

            if ($adminTab === null) {
                $adminTab = 'log';
            }

            if (!in_array($adminTab, self::AVAILABLE_ADMIN_TABS, true)) {
                session()->flash('warning', 'Opción no disponible.');
                $this->setTabs('admin', 'log');

                return;
            }

            $this->setTabs('admin', $adminTab);

            return;
        }

        $this->setTabs($tab, (string) null);
    }

    public function setTabs(string $tab, string $adminTab): void
    {
        $this->tab = $tab;
        $this->adminTab = $adminTab;
    }
}
