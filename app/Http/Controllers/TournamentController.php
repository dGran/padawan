<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Tournament;

class TournamentController extends Controller
{
    public function index()
    {
    	$tournaments = Tournament::orderBy('created_at', 'desc')->get();
    	return view('tournaments.list', ['tournaments' => $tournaments]);
    }

    public function view(Tournament $tournament)
    {
        return view('tournament.index', ['tournament' => $tournament]);
    }
}
