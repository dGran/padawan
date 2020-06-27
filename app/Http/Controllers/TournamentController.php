<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
// use App\Exports\PositionsExport;
// use App\Imports\PositionsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Toournament;
use App\Game;

class TournamentController extends Controller
{
    public function index()
    {
    	return view('tournaments.list');
    }
}
