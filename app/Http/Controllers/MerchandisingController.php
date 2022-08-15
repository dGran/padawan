<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchandisingController extends Controller
{
    public function index()
    {
//        TODO
        return back()->with('info', 'Próximamente...');
    }
}
