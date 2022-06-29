<?php

namespace App\Http\Controllers;

use App\Models\Notification as NotificationModel;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();

        return view('account.notifications', [
            'user' => $user
        ]);
    }

    public function view(NotificationModel $notification)
    {
        dd('view notification');

//        $this->emit("openModal", "modals.notification-modal", ["id" => $id]);
//
//        $notification = NotificationModel::find($id);
//        $notification->read = 1;
//        $notification->save();
    }

    public function delete(NotificationModel $notification)
    {
        $notification->delete();

        return back();
    }

    public function toggleRead(NotificationModel $notification): \Illuminate\Http\RedirectResponse
    {
        $notification->read = !$notification->read;
        $notification->save();

        return back();
    }

    public function readAll(User $user)
    {
        $notifications = NotificationModel::where('user_id', $user->id)->where('read', false)->get();
        foreach ($notifications as $notification) {
            $notification->setRead(true);
            $notification->save();
        }

        return back()->with('success', 'Todas las notificaciones se han marcado como leídas');
    }
}
