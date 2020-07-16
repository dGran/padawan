<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ParticipantsExport;
use App\Imports\ParticipantsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Participant;
use App\Tournament;
use App\Season;
use App\User;
use App\ETeam;
use App\Team;

class ParticipantController extends Controller
{
	public function selector()
	{
		$tournaments = Tournament::orderBy('name')->get();

		if ($tournaments->count() == 0) {
            flash()->error('No existen torneos, debe existir al menos uno para poder acceder a los participantes');
            return back();
		}

		return view('admin.participants.selector', ['tournaments' => $tournaments]);
	}

	public function selectorSelect()
	{
		$tournament = Tournament::find(request()->tournament_id);

		if ($tournament && request()->season_slug) {
			return redirect()->route('admin.participants', [$tournament, request()->season_slug]);
		} else {
			return back();
		}
	}

    public function loadSeasons($tournament_id)
    {
		$seasons = Season::where('tournament_id', '=', $tournament_id)->orderBy('name')->get();

		if ($seasons->count()> 0) {
    		return view('admin.participants.selector.seasons', ['seasons' => $seasons])->render();
		}
    }

    public function list(Tournament $tournament, Season $season)
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('participant_page')) {
                $page = request()->session()->get('participant_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('participant_perPage')) {
                $perPage = request()->session()->get('participant_perPage');
            }
            if (request()->session()->get('participant_order')) {
                $order = request()->session()->get('participant_order');
            }
            if (request()->session()->get('participant_filterName')) {
                $filterName = request()->session()->get('participant_filterName');
            }
        }

        $order_ext = $this->getOrder($order, $tournament);

        $participants = Participant::
        select('participants.*', 'teams.name', 'users.name', 'eteams.name')
        ->leftJoin('teams', 'teams.id', '=', 'participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'participants.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'participants.eteam_id')
        ->seasonId($season->id)
        ->name($filterName)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $participants->lastPage()) {
            $page = $participants->lastPage();
        }
		$participants = Participant::
        select('participants.*', 'teams.name', 'users.name', 'eteams.name')
        ->leftJoin('teams', 'teams.id', '=', 'participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'participants.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'participants.eteam_id')
        ->seasonId($season->id)
        ->name($filterName)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['participant_perPage' => $perPage]);
        session(['participant_page' => $page]);
        session(['participant_order' => $order]);
        session(['participant_filterName' => $filterName]);

    	return view('admin.participants.list', ['participants' => $participants, 'tournament' => $tournament, 'season' => $season, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, Season $season, $id)
    {
        $participant = Participant::findOrFail($id);
        return view('admin.participants.view', ['participant' => $participant, 'tournament' => $tournament, 'season' => $season]);
    }

    public function add(Tournament $tournament, Season $season)
    {
    	if ($season->fullParticipants()) {
            flash()->error('Se ha alcanzado el máximo de participantes');
            return back();
    	} else {
	    	$users = null;
	    	$eteams = null;
	    	$teams = null;

	    	if ($tournament->participant_type == 'individual') {
		        $users = \DB::table("users")->select('*')
		                ->whereNotIn('id', function($query) use ($season) {
		                   $query->select('user_id')->from('participants')->whereNotNull('user_id')->where('season_id', '=', $season->id);
		                })
		                ->whereNotIn('id', function($query) use ($season) {
		                   $query->select('user_id')->from('reserves')->whereNotNull('user_id')->where('season_id', '=', $season->id);
		                })
		                ->orderBy('name', 'asc')
		                ->get();
	    		if ($users->count() == 0) {
		            flash()->error('No existen más usuarios que no sean ya participantes o reservas');
		            return back();
	    		}
	    	}
	    	if ($tournament->participant_type == 'eteam') {
	    		$eteams = ETeam::select('*')->orderBy('name')->get();
		        $eteams = \DB::table("eteams")->select('*')
		                ->whereNotIn('id', function($query) use ($season) {
		                   $query->select('eteam_id')->from('participants')->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
		                })
		                ->whereNotIn('id', function($query) use ($season) {
		                   $query->select('eteam_id')->from('reserves')->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
		                })
		                ->orderBy('name', 'asc')
		                ->get();
	    		if ($eteams->count() == 0) {
		            flash()->error('No existen más e-teams que no sean ya participantes o reservas');
		            return back();
	    		}
	    	}
	    	if ($tournament->use_teams) {
		        $teams = \DB::table("teams")->select('*')
		        		->where('game_id', '=', $tournament->game_id)
		                ->whereNotIn('id', function($query) use ($season) {
		                   $query->select('team_id')->from('participants')->whereNotNull('team_id')->where('season_id', '=', $season->id);
		                })
		                ->orderBy('name', 'asc')
		                ->get();
	    		if ($teams->count() == 0) {
		            flash()->error('No existen más equipos que no sean ya participantes');
		            return back();
	    		}
	    	}

	    	return view('admin.participants.add', ['tournament' => $tournament, 'season' => $season, 'users' => $users, 'eteams' => $eteams, 'teams' => $teams]);
    	}
    }

    public function save(Tournament $tournament, Season $season, Request $request)
    {
    	if ($season->fullParticipants()) {
            flash()->error('Se ha alcanzado el máximo de participantes');
            return back();
    	} else {
	        $data = $request->all();

			$data['season_id'] = $season->id;
	        $participant = Participant::create($data);

	        if ($participant->save()) {
	            flash()->success('Registro creado correctamente');
	            return redirect()->route('admin.participants', [$tournament, $season]);
	        }
    	}
    }

    public function edit(Tournament $tournament, Season $season, $id)
    {
    	$participant = Participant::findOrFail($id);

    	$users = null;
    	$eteams = null;
    	$teams = null;

    	if ($tournament->participant_type == 'individual') {
	        $users = \DB::table("users")->select('*')
	                ->whereNotIn('id', function($query) use ($season, $participant) {
	                   $query->select('user_id')->from('participants')->where('user_id', '!=', $participant->user_id)->whereNotNull('user_id')->where('season_id', '=', $season->id);
	                })
	                ->whereNotIn('id', function($query) use ($season, $participant) {
	                   $query->select('user_id')->from('reserves')->where('user_id', '!=', $participant->user_id)->whereNotNull('user_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    	}
    	if ($tournament->participant_type == 'eteam') {
    		$eteams = ETeam::select('*')->orderBy('name')->get();
	        $eteams = \DB::table("eteams")->select('*')
	                ->whereNotIn('id', function($query) use ($season, $participant) {
	                   $query->select('eteam_id')->from('participants')->where('eteam_id', '!=', $participant->eteam_id)->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
	                })
	                ->whereNotIn('id', function($query) use ($season, $participant) {
	                   $query->select('eteam_id')->from('reserves')->where('eteam_id', '!=', $participant->eteam_id)->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    	}
    	if ($tournament->use_teams) {
	        $teams = \DB::table("teams")->select('*')
	        		->where('game_id', '=', $tournament->game_id)
	                ->whereNotIn('id', function($query) use ($season, $participant) {
	                   $query->select('team_id')->from('participants')->where('team_id', '!=', $participant->team_id)->whereNotNull('team_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    	}

    	return view('admin.participants.edit', ['participant' => $participant, 'tournament' => $tournament, 'season' => $season, 'users' => $users, 'eteams' => $eteams, 'teams' => $teams]);
    }

    public function update(Tournament $tournament, Season $season, $id, Request $request)
    {
    	$participant = Participant::findOrFail($id);

        $data = $request->all();
        $participant->fill($data);

        if ($participant->isDirty()) {
            $participant->update($data);
            if ($participant->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.participants', [$tournament, $season]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.participants', [$tournament, $season]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.participants', [$tournament, $season]);
        }
    }

    public function destroy(Tournament $tournament, Season $season, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $participant = Participant::find($ids[$i]);
            if ($participant && $participant->canDestroy()) {
                $counter++;
                $participant->delete();
            }
        }
        if ($counter > 0) {
            if ($counter == 1) {
                flash()->success('Registro eliminado correctamente');
            } else {
                flash()->success('Registros eliminados correctamente');
            }
            return back()->with('page', 1);
        } else {
            flash()->error('Acción cancelada. Los registros no han podido ser eliminados.');
            return back();
        }
    }

    public function export(Tournament $tournament, Season $season, $format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order, $tournament);
        $participants = Participant::
        select('participants.*', 'teams.name', 'users.name', 'eteams.name')
        ->leftJoin('teams', 'teams.id', '=', 'participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'participants.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'participants.eteam_id')
        ->whereIn('participants.id', $ids)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new ParticipantsExport($participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new ParticipantsExport($participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new ParticipantsExport($participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal(Tournament $tournament, Season $season, $format, $filename, $order) {
        $order_ext = $this->getOrder($order, $tournament);
        $participants = Participant::
        select('participants.*', 'teams.name', 'users.name', 'eteams.name')
        ->leftJoin('teams', 'teams.id', '=', 'participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'participants.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'participants.eteam_id')
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new ParticipantsExport($participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new ParticipantsExport($participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new ParticipantsExport($participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function import(Tournament $tournament)
    {
        if (request()->hasFile('fileImport')) {
            Excel::import(new ParticipantsImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }



    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order, $tournament) {
        if ($tournament->use_teams) {
        	$name_field = "teams.name";
        } else {
            if ($tournament->participant_type == "individual") {
            	$name_field = "users.name";
            } else {
            	$name_field = "eteams.name";
            }
        }
        $order_ext = [
            'id' => [
                'sortField'     => 'participants.id',
                'sortDirection' => 'asc'
            ],
            'id_desc' => [
                'sortField'     => 'participants.id',
                'sortDirection' => 'desc'
            ],
            'name' => [
                'sortField'     => $name_field,
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => $name_field,
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}
