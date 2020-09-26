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
use App\Match;
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

        $competition = null;
        if ($season->competitions->count() > 1) {
            if (request()->session()->get($season->id . '_user_competition')) {
                $competition = request()->session()->get($season->id . '_user_competition');
                if ($competition->season_id != $season->id) {
                    $competition = null;
                }
            }
        }
        session([$season->id . '_user_competition' => $competition]);

        $phase = null;
        if ($competition && $competition->phases->count() > 1) {
            if (request()->session()->get($season->id . '_user_phase')) {
                $phase = request()->session()->get($season->id . '_user_phase');
                if ($phase->competition_id != $competition->id) {
                    $phase = null;
                }
            }
        }
        session([$season->id . '_user_phase' => $phase]);

        $group = null;
        if ($phase && $phase->groups->count() > 1) {
            if (request()->session()->get($season->id . '_user_group')) {
                $group = request()->session()->get($season->id . '_user_group');
                if ($group->phase_id != $phase->id) {
                    $group = null;
                }
            }
        }
        session([$season->id . '_user_group' => $group]);

        return view('tournament.index', ['tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function rules(Tournament $tournament, Season $season)
    {
        $competition = null;
        if ($season->competitions->count() > 1) {
            if (request()->session()->get($season->id . '_user_competition')) {
                $competition = request()->session()->get($season->id . '_user_competition');
                if ($competition->season_id != $season->id) {
                    $competition = null;
                }
            }
        }
        session([$season->id . '_user_competition' => $competition]);

        $phase = null;
        if ($competition && $competition->phases->count() > 1) {
            if (request()->session()->get($season->id . '_user_phase')) {
                $phase = request()->session()->get($season->id . '_user_phase');
                if ($phase->competition_id != $competition->id) {
                    $phase = null;
                }
            }
        }
        session([$season->id . '_user_phase' => $phase]);

        $group = null;
        if ($phase && $phase->groups->count() > 1) {
            if (request()->session()->get($season->id . '_user_group')) {
                $group = request()->session()->get($season->id . '_user_group');
                if ($group->phase_id != $phase->id) {
                    $group = null;
                }
            }
        }
        session([$season->id . '_user_group' => $group]);

        return view('tournament.rules', ['tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function participants(Tournament $tournament, Season $season)
    {
        $competition = null;
        if ($season->competitions->count() > 1) {
            if (request()->session()->get($season->id . '_user_competition')) {
                $competition = request()->session()->get($season->id . '_user_competition');
                if ($competition->season_id != $season->id) {
                    $competition = null;
                }
            }
        }
        session([$season->id . '_user_competition' => $competition]);

        $phase = null;
        if ($competition && $competition->phases->count() > 1) {
            if (request()->session()->get($season->id . '_user_phase')) {
                $phase = request()->session()->get($season->id . '_user_phase');
                if ($phase->competition_id != $competition->id) {
                    $phase = null;
                }
            }
        }
        session([$season->id . '_user_phase' => $phase]);

        $group = null;
        if ($phase && $phase->groups->count() > 1) {
            if (request()->session()->get($season->id . '_user_group')) {
                $group = request()->session()->get($season->id . '_user_group');
                if ($group->phase_id != $phase->id) {
                    $group = null;
                }
            }
        }
        session([$season->id . '_user_group' => $group]);

        return view('tournament.participants', ['tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function standing(Tournament $tournament, Season $season, Competition $competition = null, Phase $phase = null, Group $group = null)
    {
        if (!isset($competition)) {
            if (!$season->competitions) {
                flash()->info('Estructura de la competición en configuración...');
                return back();
            }
            $competition = $season->competitions->first();
        }
        if ($season->competitions->count() > 1) {
            session([$season->id . '_user_competition' => $competition]);
        }

        if (!isset($phase)) {
            if (!$competition->phases) {
                flash()->info('Estructura de la competición en configuración...');
                return back();
            }
            $phase = $competition->phases->first();
        }
        if ($competition->phases->count() > 1) {
            session([$season->id . '_user_phase' => $phase]);
        }

        if (!isset($group)) {
            if (!$phase->groups) {
                flash()->info('Estructura de la competición en configuración...');
                return back();
            }
            $group = $phase->groups->first();
        }
        if ($phase->groups->count() > 1) {
            session([$season->id . '_user_group' => $group]);
        }

        switch ($phase->mode) {
            case 'race':
                if ($group && $group->racing) {
                    $racing = $group->racing;
                    $positions = $racing->generate_table();
                    return view('tournament.standing.races', ['racing' => $racing, 'positions' => $positions, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
                }
                flash()->info('Estructura de la competición en configuración...');
                return back();
                break;
            case 'league':
                if ($group && $group->league) {
                    $league = $group->league;
                    $positions = $league->generate_table();
                    return view('tournament.standing.leagues', ['league' => $league, 'positions' => $positions, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
                }
                flash()->info('Estructura de la competición en configuración...');
                return back();
                break;
            case 'playoff':
                flash()->info('Clasificación de playoffs en desarrollo...');
                return back();
                break;
        }
    }

    public function schedule(Tournament $tournament, Season $season = null, Competition $competition = null, Phase $phase = null, Group $group = null)
    {
        if (!isset($competition)) {
            if (!$season->competitions) {
                flash()->info('Estructura de la competición en configuración...competiciones');
                return back();
            }
            $competition = $season->competitions->first();
        }
        if ($season->competitions->count() > 1) {
            session([$season->id . '_user_competition' => $competition]);
        }

        if (!isset($phase)) {
            if (!$competition->phases) {
                flash()->info('Estructura de la competición en configuración...fases');
                return back();
            }
            $phase = $competition->phases->first();
        }
        if ($competition->phases->count() > 1) {
            session([$season->id . '_user_phase' => $phase]);
        }

        if (!isset($group)) {
            if (!$phase->groups) {
                flash()->info('Estructura de la competición en configuración...grupos');
                return back();
            }
            $group = $phase->groups->first();
        }
        if ($phase->groups->count() > 1) {
            session([$season->id . '_user_group' => $group]);
        }

        switch ($phase->mode) {
            case 'race':
                if ($group && $group->racing) {
                    $racing = $group->racing;
                    return view('tournament.schedule.races', ['racing' => $racing, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
                }
                flash()->info('Estructura de la competición en configuración...');
                return back();
                break;
            case 'league':
                if ($group && $group->league) {
                    $league = $group->league;
                    return view('tournament.schedule.leagues', ['league' => $league, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group ]);
                }
                flash()->info('Estructura de la competición en configuración...');
                return back();
                break;
            case 'playoff':
                flash()->info('Calendario de playoffs en desarrollo...');
                return back();
                break;
        }
    }

    public function scheduleMatch(Tournament $tournament, Season $season, $match_id)
    {
        $match = Match::findOrFail($match_id);

        return view('tournament.schedule.leagues.match', ['match' => $match, 'tournament' => $tournament, 'season' => $season, 'competition' => $match->competition, 'phase' => $match->group->phase, 'group' => $match->group]);
    }

    public function scheduleRace(Tournament $tournament, Season $season, $race_slug, Competition $competition = null, Phase $phase = null, Group $group = null)
    {
        $race = Race::where('slug', $race_slug)->first();

        if ($race->finished()) {
            return redirect()->route('tournament.schedule.race.result', [$tournament, $season, $race_slug]);
        }

        return redirect()->route('tournament.schedule.race.circuit', [$tournament, $season, $race_slug]);
    }

    public function scheduleRaceCircuit(Tournament $tournament, Season $season, $race_slug, Competition $competition = null, Phase $phase = null, Group $group = null)
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

    public function scheduleRaceQualy(Tournament $tournament, Season $season, $race_slug, Competition $competition = null, Phase $phase = null, Group $group = null)
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

    public function scheduleRaceResult(Tournament $tournament, Season $season, $race_slug, Competition $competition = null, Phase $phase = null, Group $group = null)
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

    public function scheduleRaceMultimedia(Tournament $tournament, Season $season, $race_slug, Competition $competition = null, Phase $phase = null, Group $group = null)
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
