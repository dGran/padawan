<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\GameCircuit;
use App\Tournament;
use App\Season;
use App\Competition;
use App\Phase;
use App\Group;
use App\GroupParticipant;
use App\Racing;
use App\RacingScore;
use App\Race;

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
        $racing = $group->racing;
        $races = Race::where('racing_id', $racing->id)->orderBy('date', 'asc')->get();

        return view('admin.racings.schedule', ['racing' => $racing, 'races' => $races, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function scheduleAddRace(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
        $circuits = GameCircuit::where('game_id', '=', $tournament->game->id)->orderBy('name', 'asc')->get();

        return view('admin.racings.schedule.add', ['circuits' => $circuits, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function scheduleSaveRace(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();
        $data['racing_id'] = $group->racing->id;
        $data['slug'] = Str::slug($request->name, '-');

        $race = Race::create($data);

        if ($race->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.seasons.schedule', $tournament, $season, $competition, $phase, $group);
        }
    }

    public function standings(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
        $racing = $group->racing;
        $races = Race::where('racing_id', $racing->id)->orderBy('date', 'asc')->get();
        $participants = GroupParticipant::where('group_id', $group->id)->orderBy('id', 'asc')->get();

        $results = [];
        foreach ($races->results as $result) {
            $results['participant_id'] = $result->group_participant_id;
            $score = RacingScore::where('racing_id', '=', $racing->id)->where('position', '=', $result->position)->get()->score;
            $results['score'] += $score;
        }

        return view('admin.racings.schedule', ['racing' => $racing, 'races' => $races, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }
}
