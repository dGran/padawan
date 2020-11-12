<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Eteam;

class EsportsController extends Controller
{
    public function index()
    {
    	$filterName = request()->filterName;
    	$filterGame = request()->filterGame;

    	if ($filterGame > 0) {
	    	$game = Game::find($filterGame);
	    	$filterGameName = $game->name . ' - ' . $game->platform->name;
    	} else {
    		$filterGameName = '';
    	}

        $eteams = ETeam::name($filterName)->game($filterGame)->orderBy('name', 'asc')->get();
    	$games = Game::orderBy('name', 'asc')->get();

        return view('esports.index', ['games' => $games, 'eteams' => $eteams, 'filterName' => $filterName, 'filterGame' => $filterGame, 'filterGameName' => $filterGameName]);
    }

    public function eteam(ETeam $eteam)
    {
        return view('esports.eteam.info.index', ['eteam' => $eteam]);
    }

    public function eteamMembers(ETeam $eteam)
    {
        return view('esports.eteam.members.index', ['eteam' => $eteam]);
    }

    public function eteamStats(ETeam $eteam)
    {
        return view('esports.eteam.stats.index', ['eteam' => $eteam]);
    }

    public function eteamAdmin(ETeam $eteam)
    {
        return view('esports.eteam.admin.index', ['eteam' => $eteam]);
    }
}
