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
        $user = auth()->user();

        $notification->read = true;
        $notification->save();

        $lastNotifications = NotificationModel::where('user_id', $user->id)->orderBy('notifications.created_at', 'desc')->take(10)->get();

        return view('account.notifications.view', [
            'user' => $user,
            'notification' => $notification,
            'lastNotifications' => $lastNotifications
        ]);
    }

    public function delete(NotificationModel $notification)
    {
        $notification->delete();

        return redirect()->route('notifications');
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
