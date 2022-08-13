<?php

namespace App\Http\Livewire\Eteam;

use App\Http\Managers\NotificationManager;
use App\Models\ETeam as Team_Esport;
use App\Models\ETeamRequest;
use App\Models\User;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Eteam extends Component
{
    use WithPagination;

    public $tab = "sede";
    public $adminTab;
    public $lastAdminTab;

    public $eteam;
    public $game_id, $name, $short_name, $logo, $country_id, $location, $presentation, $presentation_video, $website, $whatsapp, $facebook, $instagram, $twitter, $twitch, $youtube;
    public $members;

    protected $queryString = [
        'tab' => ['except' => '', 'as' => 'op'],
        'adminTab' => ['except' => '', 'as' => 'ad']
    ];

    /** dependency injections */

    public function getNotificationManagerProperty(): NotificationManager
    {
        return resolve(NotificationManager::class);
    }

    public function mount()
    {
//        if (request()->tab) { $this->tab = request()->tab; }
//        if (request()->adminTab) {
//            $this->tab = 'admin';
//            $this->adminTab = request()->adminTab;
//        }

        $eteamSlug = request()->slug;
        $this->eteam = Team_Esport::where('slug', $eteamSlug)->first();

        if (empty($this->eteam)) {
            return redirect()->route('eteams')->with('error', 'No existe el equipo '.$eteamSlug);
        }
    }

    public function render()
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

    public function RequestJoin($eteam_id): void
    {
        if (Auth::check()) {

            $eteam = Team_Esport::find($eteam_id);
            $user = User::find(Auth::user()->id);

            $request = ETeamRequest::create([
                'eteam_id' => $eteam_id,
                'user_id' => $user->id,
                'state' => 'pending',
                'message' => 'Hola, quiero unirme a vuestro equipo, gracias.'
            ]);

            foreach ($eteam->getCaptains() as $captain) {
                //send notification with helper
                $content = "$user->name ha enviado solicitud de ingreso en tu equipo";
                if ($request->message) {
                    $content .= " y ha dejado el siguiente mensaje:</br></br>\"$request->message\"";
                } else {
                    $content .= ".";
                }
                $content .= "</br></br>Como capitán puedes aceptar y rechazar la solicitud de ingreso.";

                $notification_data = [
                    'user_id' => $captain->user_id,
                    'title' => "$user->name ha solicitado el ingreso en tu equipo '$eteam->name'",
                    'content' => $content,
                    'link' => Route('my-teams'),
                    'link_title' => 'Mis equipos',
                    'read' => 0
                ];
                $this->notificationManager->create($notification_data);
            }
        }
    }

    public function CancelRequestJoin($eteam_id): void
    {
        if (Auth::check()) {

            $eteam = Team_Esport::find($eteam_id);
            $user = User::find(Auth::user()->id);

            $eteamRequests = ETeamRequest::where('eteam_id', $eteam_id)->where('user_id', $user->id)->get();
            foreach ($eteamRequests as $request) {
                $request->delete();
            }

            foreach ($eteam->getCaptains() as $captain) {
                //send notification with helper
                $notification_data = [
                    'user_id' => $captain->user_id,
                    'title' => "Retirada de solicitud de ingreso en tu equipo '$eteam->name'",
                    'content' => "$user->name ha retirado la solicitado de ingreso en tu equipo. </br> Puedes acceder desde el enlace",
                    'link' => Route('eteam', $eteam->slug),
                    'read' => 0
                ];
                $this->notificationManager->create($notification_data);
            }
        }
    }

    public function checkTabs($tab, $adminTab)
    {
        if (!$tab) {
            $tab = 'sede';
        } else {
            if ($tab === 'admin') {
                if (auth()->user() && auth()->user()->isAdminETeam($this->eteam->id)) {
                    if (!$adminTab) {
                        if ($this->lastAdminTab) {
                            $this->adminTab = $this->lastAdminTab;
                        } else {
                            $this->adminTab = 'perfil';
                        }
                    } else {
                        $this->adminTab = $adminTab;
                    }

                    $this->lastAdminTab = $this->adminTab;
                } else {
                    session()->flash('error', 'No estás autorizado.');
                    $this->tab = 'sede';
                    $this->adminTab = null;
                }
            } else {
                $this->adminTab = null;
            }
        }
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;
        $this->checkTabs($this->tab, $this->adminTab);
    }

    public function changeAdminTab($tab)
    {
        $this->adminTab = $tab;
        $this->checkTabs($this->tab, $this->adminTab);
    }
}
