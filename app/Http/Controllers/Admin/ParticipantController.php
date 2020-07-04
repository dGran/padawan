<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
// use App\Exports\SeasonsExport;
// use App\Imports\SeasonsImport;
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

    public function list(Tournament $tournament, $season_slug)
    {
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();
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

        $order_ext = $this->getOrder($order);

        $participants = Participant::seasonId($season->id)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $participants->lastPage()) {
            $page = $participants->lastPage();
        }
        $participants = Participant::seasonId($season->id)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['participant_perPage' => $perPage]);
        session(['participant_page' => $page]);
        session(['participant_order' => $order]);
        session(['participant_filterName' => $filterName]);

    	return view('admin.participants.list', ['participants' => $participants, 'tournament' => $tournament, 'season' => $season, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, $season_slug, $id)
    {
        $participant = Participant::findOrFail($id);
        $season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

        return view('admin.participants.view', ['tournament' => $tournament, 'season' => $season, 'tournament' => $tournament]);
    }

    public function add(Tournament $tournament, $season_slug)
    {
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

    	$users = null;
    	$eteams = null;
    	$teams = null;

    	if ($tournament->participant_type == 'individual') {
	        $users = \DB::table("users")->select('*')
	                ->whereNotIn('id', function($query) use ($season) {
	                   $query->select('user_id')->from('participants')->whereNotNull('user_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    		if ($users->count() == 0) {
	            flash()->error('No existen más usuarios que no sean ya participantes');
	            return back();
    		}
    	}
    	if ($tournament->participant_type == 'eteam') {
    		$eteams = ETeam::select('*')->orderBy('name')->get();
	        $eteams = \DB::table("eteams")->select('*')
	                ->whereNotIn('id', function($query) use ($season) {
	                   $query->select('eteam_id')->from('participants')->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    		if ($eteams->count() == 0) {
	            flash()->error('No existen más e-teams que no sean ya participantes');
	            return back();
    		}
    	}
    	if ($tournament->use_teams) {
	        $teams = \DB::table("teams")->select('*')
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

    public function save(Tournament $tournament, $season_slug, Request $request)
    {
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

        $data = $request->all();

		$data['season_id'] = $season->id;
		// $data['user_id'] = $request->user_id;
		// $data['eteam_id'] = $request->eteam_id;
		// $data['team_id'] = $request->team_id;
        $data['reserve'] = $request->reserve == 'on' ? 1 : 0;
        $participant = Participant::create($data);

        if ($participant->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.participants', [$tournament, $season_slug]);
        }
    }

    public function edit(Tournament $tournament, $id)
    {
        $season = Season::findOrFail($id);
    	if ($tournament->use_rosters) {
    		$players_databases = PlayerDatabase::select('*')->game($tournament->game_id)->orderBy('name')->get();
        	return view('admin.seasons.edit', ['season' => $season, 'tournament' => $tournament, 'players_databases' => $players_databases]);
    	}
    	return view('admin.seasons.edit', ['season' => $season, 'tournament' => $tournament]);
    }

    public function update(Tournament $tournament, $id, Request $request)
    {
        $season = Season::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'num_participants' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'num_participants.required' => 'El número de participantes es obligatorio. 0 para iliminados'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name, '-');

        $data['free_inscription'] = $request->free_inscription == 'on' ? 1 : 0;

        $season->fill($data);

        if ($season->isDirty()) {
            $season->update($data);
            if ($season->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.seasons', $tournament);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.seasons', $tournament);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.seasons', $tournament);
        }
    }

    public function destroy(Tournament $tournament, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $season = Season::find($ids[$i]);
            if ($season && $season->canDestroy()) {
                $counter++;
                $season->delete();
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

    public function duplicate(Tournament $tournament, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Season::find($ids[$i]);
            if ($original) {
                $counter++;
                $season = $original->replicate();
                $random_numer = rand(100,999);
                $season->name .= " (copia_" . $random_numer . ")";
                $season->slug = Str::slug($season->name, '-');
                $season->save();
            }
        }
        if ($counter > 0) {
            if ($counter == 1) {
                flash()->success('Registro duplicado correctamente');
            } else {
                flash()->success('Registros duplicados correctamente');
            }
            return back();
        } else {
            flash()->error('Acción cancelada. Los registros que querías duplicar ya no existen. Se ha actualizado la lista.');
            return back();
        }
    }

    public function export(Tournament $tournament, $format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order);
        $seasons = Season::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $seasons->makeHidden(['slug', 'created_at', 'updated_at']);

        switch ($format) {
            case 'xls':
                return (new SeasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new SeasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new SeasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal(Tournament $tournament, $format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $seasons = Season::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $seasons->makeHidden(['slug', 'created_at', 'updated_at']);

        switch ($format) {
            case 'xls':
                return (new SeasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new SeasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new SeasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new SeasonsImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }



    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order) {
        $order_ext = [
            'id' => [
                'sortField'     => 'id',
                'sortDirection' => 'asc'
            ],
            'id_desc' => [
                'sortField'     => 'id',
                'sortDirection' => 'desc'
            ],
            'name' => [
                'sortField'     => 'name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'name',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}
