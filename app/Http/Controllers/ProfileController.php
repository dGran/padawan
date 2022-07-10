<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();

        return view('account.profile', [
            'user' => $user
        ]);
    }
}
