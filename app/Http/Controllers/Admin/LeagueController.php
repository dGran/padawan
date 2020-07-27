<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Tournament;
use App\Season;
use App\Competition;
use App\Phase;
use App\Group;
use App\GroupParticipant;
use App\League;

class LeagueController extends Controller
{
    public function config(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
    	dd('config de league');
    }
}
