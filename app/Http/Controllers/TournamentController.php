<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Tournament;
use App\Season;

class TournamentController extends Controller
{
    public function index()
    {
    	$tournaments = Tournament::orderBy('created_at', 'desc')->get();
    	$seasons = Season::orderBy('created_at', 'desc')->get();
    	return view('tournaments.list', ['tournaments' => $tournaments, 'seasons' => $seasons]);
    }

    public function view(Tournament $tournament)
    {
        return view('tournament.index', ['tournament' => $tournament]);
    }

    public function rules(Tournament $tournament)
    {
        return view('tournament.rules', ['tournament' => $tournament]);
    }

    public function participants(Tournament $tournament)
    {
    	$season = $tournament->seasons->first();
        return view('tournament.participants', ['tournament' => $tournament, 'season' => $season ]);
    }

    public function standing(Tournament $tournament)
    {
    	if ($tournament->is_one_scpg()) {
    		$season = $tournament->one_scpg_model()['season'];
    		$competition = $tournament->one_scpg_model()['competition'];
    		$phase = $tournament->one_scpg_model()['phase'];
    		$group = $tournament->one_scpg_model()['group'];

    		if ($tournament->one_scpg_mode() == 'race') {
		        $racing = $group->racing;
		        $positions = $racing->generate_table();

				return view('tournament.standing.races', ['racing' => $racing, 'positions' => $positions, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
    		}
    	}
    }

    public function schedule(Tournament $tournament)
    {
    	if ($tournament->is_one_scpg()) {
    		$season = $tournament->one_scpg_model()['season'];
    		$competition = $tournament->one_scpg_model()['competition'];
    		$phase = $tournament->one_scpg_model()['phase'];
    		$group = $tournament->one_scpg_model()['group'];

    		if ($tournament->one_scpg_mode() == 'race') {
		        $racing = $group->racing;
		        // $positions = $racing->generate_table();

				return view('tournament.schedule.races', ['racing' => $racing, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
    		}
    	}
    }
}
