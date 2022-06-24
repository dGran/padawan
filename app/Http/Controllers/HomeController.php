<?php

namespace App\Http\Controllers;

use App\models\ETeam;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $lastUsers = User::whereNotNull('email_verified_at')->orderBy('created_at', 'desc')->take(6)->get();

        return view('dashboard', [
            'lastUsers' => $lastUsers,
        ])->with('error', 'test');
    }
}
