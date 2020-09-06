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
use App\LeagueDay;
use App\LeagueTablezone;
use App\Tablezone;

class LeagueController extends Controller
{
    public function config(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
    	$league = $group->league;
    	$tablezones = Tablezone::orderBy('name')->get();

    	return view('admin.leagues.config', ['league' => $league, 'tablezones' => $tablezones, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function configUpdate(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, Request $request)
    {
		$league = $group->league;

		$changes = false;

        $data = $request->all();

        $data['allow_draws'] = $request->allow_draws == 'on' ? 1 : 0;
        $league->fill($data);
        if ($league->isDirty()) {
        	$changes = true;
            $league->update($data);
        }

		$data['stats_mvp'] = $request->stats_mvp == 'on' ? 1 : 0;
		$data['stats_goals'] = $request->stats_goals == 'on' ? 1 : 0;
		$data['stats_assists'] = $request->stats_assists == 'on' ? 1 : 0;
		$data['stats_yellow_cards'] = $request->stats_yellow_cards == 'on' ? 1 : 0;
		$data['stats_red_cards'] = $request->stats_red_cards == 'on' ? 1 : 0;
		$competition->fill($data);
        if ($competition->isDirty()) {
        	$changes = true;
            $competition->update($data);
        }

    	foreach ($group->participants as $key => $p) {
    		$pos = $key + 1;
    		$pos_value = request()->{"position".$pos};

    		$league_tablezone = LeagueTablezone::where('league_id', '=', $league->id)->where('position', '=', $pos)->first();
    		if ($league_tablezone) {
    			$league_tablezone->tablezone_id = $pos_value == 0 ? null : $pos_value;
    			if ($league_tablezone->isDirty()) {
    				$changes = true;
    				$league_tablezone->update();
    			}
    		}
    	}

        if ($changes) {
            if ($league->update()) {
                flash()->success('Cambios guardados correctamente');
                return back();
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return back();
            }
        } else {
            flash()->info('No se han detectado cambios');
            return back();
        }
    }

    public function schedule(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
        $league = $group->league;
        $days = LeagueDay::where('league_id', $league->id)->orderBy('order', 'asc')->get();

        return view('admin.leagues.schedule', ['league' => $league, 'days' => $days, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }
}
