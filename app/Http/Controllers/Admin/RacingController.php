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
use App\Racing;
use App\RacingScore;

class RacingController extends Controller
{
    public function config(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
    	$racing = $group->racing;
    	$racing_scores = RacingScore::where('racing_id', $racing->id)->orderBy('position', 'asc')->get();

    	return view('admin.racings.config', ['racing' => $racing, 'racing_scores' => $racing_scores, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function configUpdate(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, Request $request)
    {
		$racing = $group->racing;
		dd('update!');
    }

    public function configUpdateScore($id, Request $request)
    {
    	$score = RacingScore::findOrFail($id);
    	$score->score = $request->score == null || $request->score > 999 ? 0 : $request->score;
    	$score->save();

    	return $score->score;
    	exit;
    }

    public function configRestoreScores(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
    	foreach ($group->racing->scores as $score) {
    		$score->score = 0;
    		$score->save();
    	}
        flash()->success('Puntuaciones restauradas correctamente');
        return back();
    }

    public function schedule(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
    	dd('schedule');
    }

    public function standings(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
    	dd('standings');
    }
}
