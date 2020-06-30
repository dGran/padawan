<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\SeasonsExport;
use App\Imports\SeasonsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Tournament;
use App\Season;
use App\PlayerDatabase;

class SeasonController extends Controller
{
	public function selector()
	{
		$tournaments = Tournament::orderBy('name')->get();

		if ($tournaments->count() == 0) {
            flash()->error('No existen torneos, debe existir al menos uno para poder crear una nueva temporada');
            return back();
		}

		return view('admin.seasons.selector', ['tournaments' => $tournaments]);
	}

	public function selectorSelect()
	{
		return redirect()->route('admin.seasons', request()->tournament);
	}

    public function list(tournament $tournament)
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('season_page')) {
                $page = request()->session()->get('season_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('season_perPage')) {
                $perPage = request()->session()->get('season_perPage');
            }
            if (request()->session()->get('season_order')) {
                $order = request()->session()->get('season_order');
            }
            if (request()->session()->get('season_filterName')) {
                $filterName = request()->session()->get('season_filterName');
            }
        }

        $order_ext = $this->getOrder($order);

        $seasons = Season::name($filterName)->tournament($tournament->id)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $seasons->lastPage()) {
            $page = $seasons->lastPage();
        }
        $seasons = Season::name($filterName)->tournament($tournament->id)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['season_perPage' => $perPage]);
        session(['season_page' => $page]);
        session(['season_order' => $order]);
        session(['season_filterName' => $filterName]);

    	return view('admin.seasons.list', ['seasons' => $seasons, 'tournament' => $tournament, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(tournament $tournament, $id)
    {
        $season = Season::findOrFail($id);
        return view('admin.seasons.view', ['season' => $season, 'tournament' => $tournament]);
    }

    public function add(tournament $tournament)
    {
    	if ($tournament->use_rosters) {
    		$players_databases = PlayerDatabase::select('*')->game($tournament->game_id)->orderBy('name')->get();
    		if ($players_databases->count() == 0) {
	            flash()->error('No existen databases para el juego, debe existir al menos una para poder crear una nueva temporada');
	            return back();
    		}
        	return view('admin.seasons.add', ['tournament' => $tournament, 'players_databases' => $players_databases]);
    	}
    	return view('admin.seasons.add', ['tournament' => $tournament]);
    }

    public function save(tournament $tournament, Request $request)
    {
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

		$data['tournament_id'] = $tournament->id;
        $data['state'] = 'inscriptions'; // default state for new seasons
        $data['free_inscription'] = $request->free_inscription == 'on' ? 1 : 0;
        $season = Season::create($data);

        if ($season->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.seasons', $tournament);
        }
    }

    public function edit(tournament $tournament, $id)
    {
        $season = Season::findOrFail($id);
    	if ($tournament->use_rosters) {
    		$players_databases = PlayerDatabase::select('*')->game($tournament->game_id)->orderBy('name')->get();
        	return view('admin.seasons.edit', ['season' => $season, 'tournament' => $tournament, 'players_databases' => $players_databases]);
    	}
    	return view('admin.seasons.edit', ['season' => $season, 'tournament' => $tournament]);
    }

    public function update(tournament $tournament, $id, Request $request)
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

    public function destroy(tournament $tournament, $ids)
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

    public function duplicate(tournament $tournament, $ids)
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

    public function export(tournament $tournament, $format, $ids, $filename, $order)
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

    public function exportGlobal(tournament $tournament, $format, $filename, $order) {
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

    public function import(tournament $tournament)
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
