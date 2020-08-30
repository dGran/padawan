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
use App\RaceResult;
use App\RaceVideo;

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

        $data = $request->all();
        $data['fastest_lap'] = $request->fastest_lap == 'on' ? 1 : 0;
        $data['score_fastest_lap'] = $request->fastest_lap == 'on' ? $request->score_fastest_lap : 0;
        $data['pre_qualifying'] = $request->pre_qualifying == 'on' ? 1 : 0;
        $data['qualifying'] = $request->qualifying == 'on' ? 1 : 0;
        $data['score_pole'] = $request->qualifying == 'on' ? $request->score_pole : 0;
        $data['times'] = $request->times == 'on' ? 1 : 0;
        $data['show_circuit_flags'] = $request->show_circuit_flags == 'on' ? 1 : 0;

        $racing->fill($data);

        if ($racing->isDirty()) {
            $racing->update($data);
            if ($racing->update()) {
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
        $data['pre_qualifying'] = $request->pre_qualifying == 'on' ? 1 : 0;
        $data['qualifying'] = $request->qualifying == 'on' ? 1 : 0;
        $data['slug'] = Str::slug($request->name, '-');

        $race = Race::create($data);

        if ($race->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.racing.schedule', [$tournament, $season, $competition, $phase, $group]);
        }
    }

    public function scheduleEditRace(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id)
    {
        $race = Race::findOrFail($id);
        $circuits = GameCircuit::where('game_id', '=', $tournament->game->id)->orderBy('name', 'asc')->get();

        return view('admin.racings.schedule.edit', ['circuits' => $circuits, 'race' => $race, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function scheduleUpdateRace(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id, Request $request)
    {
        $race = Race::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();
        $data['racing_id'] = $group->racing->id;
        $data['pre_qualifying'] = $request->pre_qualifying == 'on' ? 1 : 0;
        $data['qualifying'] = $request->qualifying == 'on' ? 1 : 0;
        $data['slug'] = Str::slug($request->name, '-');

        $race->fill($data);

        if ($race->isDirty()) {
            $race->update($data);
            if ($race->update()) {
                flash()->success('Registro editado correctamente');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
        }
        return redirect()->route('admin.racing.schedule', [$tournament, $season, $competition, $phase, $group]);
    }

    public function scheduleDestroyRace(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id)
    {
        $race = Race::findOrFail($id);
        if ($race && $race->canDestroy()) {
            $race->delete();
            flash()->success('Registro eliminado correctamente');
            return back();
        } else {
            flash()->error('Acción cancelada. El registro no ha podido ser eliminado.');
            return back();
        }
    }

    public function scheduleRaceVideos(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id)
    {
        $race = Race::findOrFail($id);

        return view('admin.racings.schedule.videos.list', ['race' => $race, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function scheduleRaceVideosAdd(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id)
    {
        $race = Race::findOrFail($id);

        return view('admin.racings.schedule.videos.add', ['race' => $race, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function scheduleRaceVideosSave(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id, Request $request)
    {
        $data = $request->validate([
            'title'    => 'required',
            'provider' => 'required',
            'video_id' => 'required',
        ],
        [
            'title.required' => 'El título es obligatorio',
            'provider.required' => 'El proveedor del video es obligatorio',
            'video_id.required' => 'La ID del video es obligatoria',
        ]);

        $data = $request->all();
        $data['race_id'] = $id;

        $video = RaceVideo::create($data);

        if ($video->save()) {
            flash()->success('Video registrado correctamente');
            return redirect()->route('admin.racing.schedule.races.videos', [$tournament, $season, $competition, $phase, $group, $id]);
        }
    }

    public function scheduleRaceVideosEdit(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $race_id, $id)
    {
        $race = Race::findOrFail($race_id);
        $video = RaceVideo::findOrFail($id);

        return view('admin.racings.schedule.videos.edit', ['video' => $video, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group, 'race' => $race]);
    }

    public function scheduleRaceVideosUpdate(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $race_id, $id, Request $request)
    {
        $video = RaceVideo::findOrFail($id);

        $data = $request->validate([
            'title'    => 'required',
            'provider' => 'required',
            'video_id' => 'required',
        ],
        [
            'title.required' => 'El título es obligatorio',
            'provider.required' => 'El proveedor del video es obligatorio',
            'video_id.required' => 'La ID del video es obligatoria',
        ]);

        $data = $request->all();

        $video->fill($data);

        if ($video->isDirty()) {
            $video->update($data);
            if ($video->update()) {
                flash()->success('Video editado correctamente');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
        }
        return redirect()->route('admin.racing.schedule.races.videos', [$tournament, $season, $competition, $phase, $group, $race_id]);
    }

    public function scheduleRaceVideosDestroy(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $race_id, $id)
    {
        $video = RaceVideo::findOrFail($id);
        if ($video) {
            $video->delete();
            flash()->success('Video eliminado correctamente');
            return back();
        } else {
            flash()->error('Acción cancelada. El video no ha podido ser eliminado.');
            return back();
        }
    }

    public function scheduleEditRaceResults(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id)
    {
        $race = Race::findOrFail($id);
        $group_participants = GroupParticipant::where('group_id', '=', $group->id)->get();

        if ($race->qualifying) {
            $qualy_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'qualy')->orderBy('position', 'asc')->get();
            if ($qualy_results->count() == 0)
            {
                foreach ($group_participants as $group_participant) {
                    RaceResult::create([
                        'race_id'              => $race->id,
                        'group_participant_id' => $group_participant->id,
                        'user_id'              => $group_participant->participant->user_id,
                        'eteam_id'             => $group_participant->participant->eteam_id,
                        'type'                 => 'qualy',
                        'position'             => 0,
                    ]);
                }
                $qualy_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'qualy')->orderBy('position', 'asc')->get();
            }
            if ($race->pre_qualifying) {
                $prequaly_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'pre-qualy')->orderBy('position', 'asc')->get();
                if ($prequaly_results->count() == 0)
                {
                    foreach ($group_participants as $group_participant) {
                        RaceResult::create([
                            'race_id'              => $race->id,
                            'group_participant_id' => $group_participant->id,
                            'user_id'              => $group_participant->participant->user_id,
                            'eteam_id'             => $group_participant->participant->eteam_id,
                            'type'                 => 'pre-qualy',
                            'position'             => 0,
                        ]);
                    }
                    $prequaly_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'pre-qualy')->orderBy('position', 'asc')->get();
                }
            } else {
                $prequaly_results = null;
            }
        } else {
            $qualy_results = null;
            $prequaly_results = null;
        }

        $race_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'race')->orderBy('position', 'asc')->get();
        if ($race_results->count() == 0) {
            foreach ($group_participants as $group_participant) {
                RaceResult::create([
                    'race_id'              => $race->id,
                    'group_participant_id' => $group_participant->id,
                    'user_id'              => $group_participant->participant->user_id,
                    'eteam_id'             => $group_participant->participant->eteam_id,
                    'type'                 => 'race',
                    'position'             => 0,
                ]);
            }
            $race_results = RaceResult::where('race_id', '=', $race->id)->where('type', '=', 'race')->orderBy('position', 'asc')->get();
        }

        return view('admin.racings.schedule.results', ['race' => $race, 'race_results' => $race_results, 'qualy_results' => $qualy_results, 'prequaly_results' => $prequaly_results, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function scheduleUpdateRaceResults($id, Request $request)
    {
        $result = RaceResult::findOrFail($id);
        $last_position = $result->race->racing->group->num_participants;

        if ($request->position > 0) {
            $position = RaceResult::where('race_id', $result->race_id)
                ->where('type', '=', $result->type)
                ->where('position', '=', $request->position)
                ->where('group_participant_id', '!=', $result->group_participant_id)
                ->get();
            if ($position->count() > 0) {
                $request->position = 0;
            }
        }
        $result->position = ($request->position == null) || ($request->position > $last_position) ? 0 : $request->position;

        $result->save();

        return $result;
        exit;
    }

    public function scheduleResetRaceResults($id)
    {
        $results = RaceResult::where('race_id', '=', $id)->get();
        foreach ($results as $result) {
            $result->position = 0;
            $result->fastest_lap = 0;
            $result->pole = 0;
            $result->save();
        }
        exit;
    }


    public function standings(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
        $racing = $group->racing;
        $positions = $racing->generate_table();

        return view('admin.racings.standings', ['racing' => $racing, 'positions' => $positions, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }
}
