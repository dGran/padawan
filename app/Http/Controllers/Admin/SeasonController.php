<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
// use App\Exports\SeasonsExport;
// use App\Imports\SeasonsImport;
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
    	if ($tournament->participant_type == "individual" && $tournament->use_rosters) {
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
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name, '-');

        $data['state'] = 'inscriptions'; // default state for new seasons
        $data['num_participants'] = $request->num_participants == null ? 0 : $request->num_participants;
        $data['free_inscriptions'] = $request->free_inscriptions == 'on' ? 1 : 0;

        $season = Season::create($data);

        if ($season->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.seasons');
        }
    }

    public function edit($id)
    {
        $season = Season::findOrFail($id);
        $games = Game::orderBy('name')->get();

        return view('admin.seasons.edit', ['season' => $season, 'games' => $games]);
    }

    public function update($id, Request $request)
    {
        $season = Season::findOrFail($id);

        $game = Game::find($request->game_id);
        $gameName = $game->name;
        $platformName = $game->platform->name;
        $request['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:seasons,slug,' . $season->id,
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => "Ya existe $request->name en el juego $gameName ($platformName)",
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('seasons')->delete($season->img);
            $data['img'] = null;
        } else {
            if ($request->hasFile('img')) {
                $this->validate($request,[
                    'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'img.image' => 'El logo debe ser una imagen',
                    'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                    'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
                ]);

                // remove image from Storage
                \Storage::disk('seasons')->delete($season->img);

	            $img_name = $data['slug'] . time() . '.' . $request->img->extension();
                \Storage::disk('seasons')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }

        $data['use_teams'] = $request->use_teams == 'on' ? 1 : 0;
        $data['use_rosters'] = $request->use_rosters == 'on' ? 1 : 0;
        $data['use_economy'] = $request->use_economy == 'on' ? 1 : 0;
        $data['use_salaries'] = $request->use_salaries == 'on' ? 1 : 0;
        $data['use_transfers'] = $request->use_transfers == 'on' ? 1 : 0;
        $data['use_clauses'] = $request->use_clauses == 'on' ? 1 : 0;
        $data['use_free_agents'] = $request->use_free_agents == 'on' ? 1 : 0;

        $season->fill($data);

        if ($season->isDirty()) {
            $season->update($data);
            if ($season->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.seasons');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.seasons');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.seasons');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $season = Season::find($ids[$i]);
            if ($season && $season->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('seasons')->delete($season->img);
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

    public function duplicate($ids)
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
                if ($original->img) {
                    $img_name = Str::slug($season->name . ' ' . $original->game->name . ' ' . $original->game->platform->name, '-') . '_' . $original->img;
                    \Storage::disk('seasons')->copy($original->img, $img_name);
                    $season->img = $img_name;
                }
                $season->slug = Str::slug($season->name . ' ' . $original->game->name . ' ' . $original->game->platform->name, '-');
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

    public function export($format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order);
        $seasons = Season::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $seasons->makeHidden(['img','rules','slug', 'created_at', 'updated_at']);

        switch ($format) {
            case 'xls':
                return (new seasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new seasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new seasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $seasons = Season::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $seasons->makeHidden(['img','rules','slug', 'created_at', 'updated_at']);

        switch ($format) {
            case 'xls':
                return (new seasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new seasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new seasonsExport($seasons))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function import()
    {
        if (request()->hasFile('fileImport')) {
            Excel::import(new seasonsImport, request()->file('fileImport'));
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
