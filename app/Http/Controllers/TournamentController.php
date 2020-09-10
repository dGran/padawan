<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

use App\Tournament;
use App\Season;
use App\Competition;
use App\Phase;
use App\Group;
use App\Race;
use App\RaceResult;

class TournamentController extends Controller
{
    public function index()
    {
    	$tournaments = Tournament::orderBy('created_at', 'desc')->get();
    	$seasons = Season::orderBy('created_at', 'desc')->get();
    	return view('tournaments.list', ['tournaments' => $tournaments, 'seasons' => $seasons]);
    }

    public function view(Tournament $tournament, Season $season = null)
    {
        $season = $this->checkSeason($tournament, $season);
        if (!$season) {
            flash()->info('Torneo en fase de configuración, todavía no accesible');
            return redirect()->route('tournaments');
        }

        return view('tournament.index', ['tournament' => $tournament, 'season' => $season]);
    }

    public function rules(Tournament $tournament, Season $season)
    {
        return view('tournament.rules', ['tournament' => $tournament, 'season' => $season]);
    }

    public function participants(Tournament $tournament, Season $season)
    {
        return view('tournament.participants', ['tournament' => $tournament, 'season' => $season ]);
    }

    public function standing(Tournament $tournament, Season $season, Competition $competition = null, Phase $phase = null, Group $group = null)
    {
        if (!isset($competition)) {
            $competition = $season->competitions->first();
        }
        if (!isset($phase)) {
            $phase = $competition->phases->first();
        }
        if (!isset($group)) {
            $group = $phase->groups->first();
        }

        switch ($phase->mode) {
            case 'race':
                $racing = $group->racing;
                $positions = $racing->generate_table();
                return view('tournament.standing.races', ['racing' => $racing, 'positions' => $positions, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
                break;
            case 'league':
                $league = $group->league;
                return view('tournament.standing.leagues', ['league' => $league, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
                break;
            case 'playoff':
                flash()->info('Clasificación de playoffs en desarrollo...');
                return back();
                break;
        }

    // 	if ($tournament->is_one_scpg()) {
    // 		$season = $tournament->one_scpg_model()['season'];
    // 		$competition = $tournament->one_scpg_model()['competition'];
    // 		$phase = $tournament->one_scpg_model()['phase'];
    // 		$group = $tournament->one_scpg_model()['group'];

    // 		if ($tournament->one_scpg_mode() == 'race') {
		  //       $racing = $group->racing;
		  //       $positions = $racing->generate_table();

				// return view('tournament.standing.races', ['racing' => $racing, 'positions' => $positions, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
    // 		}
    // 	}
    }

    public function schedule(Tournament $tournament, Season $season = null, Competition $competition = null, Phase $phase = null, Group $group = null)
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

            if ($tournament->one_scpg_mode() == 'league') {
                $league = $group->league;
                // $positions = $racing->generate_table();

                return view('tournament.schedule.leagues', ['league' => $league, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
            }
    	}
    }

    public function scheduleRace(Tournament $tournament, Season $season = null, Competition $competition = null, Phase $phase = null, Group $group = null, $race_slug)
    {
        $race = Race::where('slug', $race_slug)->first();

        if ($race->finished()) {
            return redirect()->route('tournament.schedule.race.result', [$tournament, $race_slug]);
        }

        return redirect()->route('tournament.schedule.race.circuit', [$tournament, $race_slug]);
    }

    public function scheduleRaceCircuit(Tournament $tournament, Season $season = null, Competition $competition = null, Phase $phase = null, Group $group = null, $race_slug)
    {
		$race = Race::where('slug', $race_slug)->first();

        if ($race) {
    		$season = $race->racing->group->phase->competition->season;
    		$competition = $race->racing->group->phase->competition;
    		$phase = $race->racing->group->phase;
    		$group = $race->racing->group;

    		return view('tournament.schedule.races.race.circuit', ['race' => $race, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
        } else {
            return redirect()->route('tournament', $tournament);
        }
    }

    public function scheduleRaceQualy(Tournament $tournament, $race_slug)
    {
        $race = Race::where('slug', $race_slug)->first();

        if ($race && $race->qualys_finished()) {
            $season = $race->racing->group->phase->competition->season;
            $competition = $race->racing->group->phase->competition;
            $phase = $race->racing->group->phase;
            $group = $race->racing->group;
            $prequaly_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'pre-qualy')->orderByRaw('position = 0, position ASC')->get();
            $qualy_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'qualy')->orderByRaw('position = 0, position ASC')->get();

            return view('tournament.schedule.races.race.qualy', ['prequaly_results' => $prequaly_results, 'qualy_results' => $qualy_results, 'race' => $race, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
        }

        return redirect()->route('tournament.schedule.race.circuit', [$tournament, $race_slug]);
    }

    public function scheduleRaceResult(Tournament $tournament, Season $season = null, Competition $competition = null, Phase $phase = null, Group $group = null, $race_slug)
    {
        $race = Race::where('slug', $race_slug)->first();

        if ($race && $race->finished()) {
            $season = $race->racing->group->phase->competition->season;
            $competition = $race->racing->group->phase->competition;
            $phase = $race->racing->group->phase;
            $group = $race->racing->group;
            $results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'race')->orderByRaw('position = 0, position ASC')->get();

            return view('tournament.schedule.races.race.result', ['results' => $results, 'race' => $race, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
        }

        return redirect()->route('tournament.schedule.race.circuit', [$tournament, $race_slug]);
    }

    public function scheduleRaceMultimedia(Tournament $tournament, Season $season = null, Competition $competition = null, Phase $phase = null, Group $group = null, $race_slug)
    {
        $race = Race::where('slug', $race_slug)->first();

        if ($race && $race->has_media()) {
            $season = $race->racing->group->phase->competition->season;
            $competition = $race->racing->group->phase->competition;
            $phase = $race->racing->group->phase;
            $group = $race->racing->group;

            return view('tournament.schedule.races.race.multimedia', ['race' => $race, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
        }

        return redirect()->route('tournament.schedule.race.circuit', [$tournament, $race_slug]);
    }


    // helpers functions

    protected function checkSeason($tournament, $season)
    {
        if (isset($season)) {
            return Season::findOrFail($season->id);
        } else {
            return $tournament->currentSeason();
        }
    }
}
