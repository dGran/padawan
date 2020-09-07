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
use App\Match;

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

    public function scheduleGenerate(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
        $league = $group->league;
		$second_round = request()->second_round ? 1 : 0;
		$inverse_order = request()->inverse_order ? 1 : 0;

        $this->generate_days($league->id, $second_round, $inverse_order);

        flash()->success('Se han generado las jornadas de la liga correctamente');
        return back();
    }



    // helper functions
    protected function generate_days($league_id, $second_round, $inverse_order)
    {
    	$league = League::find($league_id);
        foreach ($league->days as $day) {
            foreach ($day->matches as $match) {
                $match->delete();
            }
            $day->delete();
        }
    	$days = LeagueDay::where('league_id', '=', $league_id)->orderBy('order', 'desc')->get();
    	if ($days->count() > 0) {
    		$next_day = $days->first()->order + 1;
    	} else {
    		$next_day = 1;
    	}

    	$next_day = $days->count() > 0 ? $days->first()->order + 1 : 1;

    	$group_participants = GroupParticipant::where('group_id', '=', $league->group->id)->inRandomOrder()->get();
		$participants = [];
		$i = 1;
		foreach ($group_participants as $participant) {
			$participants[$i] = $participant;
			$i++;
		}

		$num_participants = $league->group->num_participants;

		if ($num_participants % 2 == 0) { // num_participantes par
			$num_participants = $i-1;
		} else { // num_participantes impar
			$num_participants = $i;
			$participants[$i] = null;
		}

	    $num_players = ($num_participants > 0) ? (int)$num_participants : 4;
	    // If necessary, round up number of players to nearest even number.  -- / / Si el número necesario, reunir a los jugadores de número par más cercano.
	    $num_players += $num_players % 2;

	    // Generate matches for each round
	    for ($round = 1; $round < $num_players; $round++) {
	    	$day = new LeagueDay;
	    	$day->league_id = $league_id;
	    	$day->order = $next_day;
	    	$day->save();

			$day_to_repeat[$round]=$day->id;

	        $players_done = array();

	        // Match each player, except the last one
	        for ($player = 1; $player < $num_players; $player++) {
	            if (!in_array($player, $players_done)) {
	                // Select opponent.
	                $opponent = $round - $player;
	                $opponent += ($opponent < 0) ? $num_players : 1;

	                // Securing opponent is not the current player
	                if ($opponent != $player) {
	                    if (($player + $opponent) % 2 == 0 xor $player < $opponent) {
	                    	if ($participants[$player]->id > 0 && $participants[$opponent]->id > 0) {
							   	$match = new Match;
							   	$match->competition_id = $league->group->phase->competition->id;
							   	$match->group_id = $league->group->id;
							   	$match->day_id = $day->id;
							   	$match->local_id = $participants[$player]->id;
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
							   		if ($participants[$player]->participant->user) {
							   			$match->local_user_id = $participants[$player]->participant->user->id;
							   		}
							   	}
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
							   		if ($participants[$player]->participant->eteam) {
							   			$match->local_eteam_id = $participants[$player]->participant->eteam->id;
							   		}
							   	}
							   	$match->visitor_id = $participants[$opponent]->id;
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
							   		if ($participants[$opponent]->participant->user) {
							   			$match->visitor_user_id = $participants[$opponent]->participant->user->id;
							   		}
							   	}
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
							   		if ($participants[$opponent]->participant->eteam) {
							   			$match->visitor_eteam_id = $participants[$opponent]->participant->eteam->id;
							   		}
							   	}
							   	$match->save();
	                    	}
	                    } else {
	                        if ($participants[$opponent]->id > 0 && $participants[$player]->id > 0) {
							   	$match = new Match;
							   	$match->competition_id = $league->group->phase->competition->id;
							   	$match->group_id = $league->group->id;
							   	$match->day_id = $day->id;
							   	$match->local_id = $participants[$opponent]->id;
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
						   			if ($participants[$opponent]->participant->user) {
							   			$match->local_user_id = $participants[$opponent]->participant->user->id;
							   		}
							   	}
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
							   		if ($participants[$opponent]->participant->eteam) {
							   			$match->local_eteam_id = $participants[$opponent]->participant->eteam->id;
							   		}
							   	}
							   	$match->visitor_id = $participants[$player]->id;
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
							   		if ($participants[$player]->participant->user) {
							   			$match->visitor_user_id = $participants[$player]->participant->user->id;
							   		}
							   	}
							   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
							   		if ($participants[$player]->participant->eteam) {
							   			$match->visitor_eteam_id = $participants[$player]->participant->eteam->id;
							   		}
							   	}
							   	$match->save();
	                        }
	                    }
	                    // This pair of players are done for this round.
	                    $players_done[] = $player;
	                    $players_done[] = $opponent;
	                }
	            }
	        }

	        // Match the last player
	        if ($round % 2 == 0) {
	            $opponent = ($round + $num_players) / 2;
	            if ($participants[$num_players] != null) {


		            if ($participants[$num_players]->id > 0 && $participants[$opponent]->id > 0) {
					   	$match = new Match;
					   	$match->competition_id = $league->group->phase->competition->id;
					   	$match->group_id = $league->group->id;
					   	$match->day_id = $day->id;
					   	$match->local_id = $participants[$num_players]->id;
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
					   		if ($participants[$num_players]->participant->user) {
					   			$match->local_user_id = $participants[$num_players]->participant->user->id;
					   		}
					   	}
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
					   		if ($participants[$num_players]->participant->eteam) {
					   			$match->local_eteam_id = $participants[$num_players]->participant->eteam->id;
					   		}
					   	}
					   	$match->visitor_id = $participants[$opponent]->id;
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
					   		if ($participants[$opponent]->participant->user) {
					   			$match->visitor_user_id = $participants[$opponent]->participant->user->id;
					   		}
					   	}
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
					   		if ($participants[$opponent]->participant->eteam) {
					   			$match->visitor_eteam_id = $participants[$opponent]->participant->eteam->id;
					   		}
					   	}
					   	$match->save();
		            }
		        }
	        } else {
	            $opponent = ($round + 1) / 2;
	            if ($participants[$num_players] != null) {
					if ($participants[$opponent]->id > 0 && $participants[$num_players]->id > 0) {

					   	$match = new Match;
					   	$match->competition_id = $league->group->phase->competition->id;
					   	$match->group_id = $league->group->id;
					   	$match->day_id = $day->id;
					   	$match->local_id = $participants[$opponent]->id;
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
					   		if ($participants[$opponent]->participant->user) {
					   			$match->local_user_id = $participants[$opponent]->participant->user->id;
					   		}
					   	}
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
					   		if ($participants[$opponent]->participant->eteam) {
					   			$match->local_eteam_id = $participants[$opponent]->participant->eteam->id;
					   		}
					   	}
					   	$match->visitor_id = $participants[$num_players]->id;
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'individual') {
					   		if ($participants[$num_players]->participant->user) {
					   			$match->visitor_user_id = $participants[$num_players]->participant->user->id;
					   		}
					   	}
					   	if ($league->group->phase->competition->season->tournament->participant_type == 'eteam') {
					   		if ($participants[$num_players]->participant->eteam) {
					   			$match->visitor_eteam_id = $participants[$num_players]->participant->eteam->id;
					   		}
					   	}
					   	$match->save();
					}
				}
	        }
	        $next_day++;
	    }

		// we created the days and matches of the second round
	    if ($second_round) {
	    	if ($inverse_order) {
		    	for ($i=(count($day_to_repeat)); $i > 0; $i --) {
		    		$copy_day = LeagueDay::find($day_to_repeat[$i]);

					// first we create the new day
		    		$day = new LeagueDay;
		    		$day->league_id = $league_id;
		    		$day->order = $next_day;
		    		$day->save();

					// now we create the matches of the day going through the matches of the day of the first round
		    		foreach ($copy_day->matches as $copy_match) {
		    			$match = new Match;
					   	$match->competition_id = $league->group->phase->competition->id;
					   	$match->group_id = $league->group->id;
		    			$match->day_id = $day->id;
		    			$match->local_id = $copy_match->visitor_id;
		    			$match->local_user_id = $copy_match->visitor_user_id;
		    			$match->local_eteam_id = $copy_match->visitor_eteam_id;
		    			$match->visitor_id = $copy_match->local_id;
		    			$match->visitor_user_id = $copy_match->local_user_id;
		    			$match->visitor_eteam_id = $copy_match->visitor_eteam_id;
		    			$match->save();
		    		}
		    		$next_day++;
		    	}
	    	} else {
		    	for ($i=1; $i < (count($day_to_repeat)+1); $i ++) {
		    		$copy_day = LeagueDay::find($day_to_repeat[$i]);

					// first we create the new day
		    		$day = new LeagueDay;
		    		$day->league_id = $league_id;
		    		$day->order = $next_day;
		    		$day->save();

					// now we create the matches of the day going through the matches of the day of the first round
		    		foreach ($copy_day->matches as $copy_match) {
		    			$match = new Match;
					   	$match->competition_id = $league->group->phase->competition->id;
					   	$match->group_id = $league->group->id;
		    			$match->day_id = $day->id;
		    			$match->local_id = $copy_match->visitor_id;
		    			$match->local_user_id = $copy_match->visitor_user_id;
		    			$match->local_eteam_id = $copy_match->visitor_eteam_id;
		    			$match->visitor_id = $copy_match->local_id;
		    			$match->visitor_user_id = $copy_match->local_user_id;
		    			$match->visitor_eteam_id = $copy_match->local_eteam_id;
		    			$match->save();
		    		}
		    		$next_day++;
		    	}
	    	}
	    }
    }
}
