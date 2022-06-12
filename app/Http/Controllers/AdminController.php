<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:access admin panel']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
