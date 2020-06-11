<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
    	return view('home.home');
    }

    public function profile()
    {
        $profile = auth()->user()->profile;
        return view('users.profile', compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;

        $profile->location = $request->location;
        $profile->birthdate = $request->birthdate;
        $profile->ps_id = $request->ps_id;
        $profile->xbox_id = $request->xbox_id;
        $profile->steam_id = $request->steam_id;
        $profile->origin_id = $request->origin_id;
        $profile->whatsapp = $request->whatsapp;
        $profile->facebook = $request->facebook;
        $profile->instagram = $request->instagram;
        $profile->twitter = $request->twitter;
        $profile->notifications = is_null($request->notifications) ? 0 : 1;

        if ($request->deleteAvatar) {
            // remove image from Storage
            \Storage::disk('avatars')->delete($profile->avatar);
            $profile->avatar = null;
        } else {
            if ($request->hasFile('avatar')) {
                $this->validate($request,[
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'avatar.image' => 'El avatar debe ser una imagen',
                    'avatar.mimes' => 'El avatar debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                    'avatar.max' => 'El tamaño del avatar no puede ser mayor a 2048 bytes'
                ]);

                // remove image from Storage
                \Storage::disk('avatars')->delete($profile->avatar);

                $avatar_name = 'avatar_' . $user->id .'&' . time() . '.' . $request->avatar->extension();
                \Storage::disk('avatars')->put($avatar_name, \File::get($request->file('avatar')));

                $profile->avatar = $avatar_name;
            }
        }

        if ($profile->isDirty()) {
            if ($profile->save()) {
                flash()->success('Perfil actualizado correctamente');
            } else {
                flash()->error('El perfil no se ha actualizado, se ha producido un error en el servidor');
            }
        } else {
            flash()->info('No se han detectado cambios');
        }
        return back();
    }

    public function privacy_policy()
    {
        return view('home.privacy_policy');
    }

    public function cookie_policy()
    {
        return view('home.cookie_policy');
    }
}