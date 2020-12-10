<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Mail;
use App\Notification;
use App\ETeamUser;
use App\Events\RequestEteam;


class SendEteamRequestNotification
{

    public function __construct()
    {
        //
    }

    public function handle(RequestEteam $event)
    {
        if ($event->request->send_by == "user") {
            $eteamAdmins = ETeamUser::where('eteam_id', $event->request->eteam->id)->where('admin', 1)->get();
            foreach ($eteamAdmins as $admin) {
                $notification = Notification::create([
                    'user_id' => $admin->user_id,
                    'eteam_request_id' => $event->request->id,
                    'match_id' => null,
                    'text' => $event->request->user->name . " ha enviado una solicitud de ingreso a tu equipo " . '"' . $event->request->eteam->name . '"',
                    'read' => 0
                ]);
            }
        } else {
            $notification = Notification::create([
                'user_id' => $event->request->user_id,
                'eteam_request_id' => $event->request->id,
                'match_id' => null,
                'text' => "El equipo " . '"' . $event->request->eteam->name . '"' . " te ha enviado una solicitud de ingreso",
                'read' => 0
            ]);
        }

        // $data = array('name' => $event->user->name, 'email' => $event->user->email, 'body' => 'Bienvenido a mi sitio personal en donde comparto artículos de desarrollo web.');

        // Mail::send('emails.mail', $data, function($message) use ($data) {
        //     $message->to($data['email'])
        //             ->subject('Bienvenido a Gabriel Chávez');
        //     $message->from('contacto@gabrielchavez.me');
        // });
    }
}
