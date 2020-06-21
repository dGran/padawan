<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\TeamsExport;
use App\Imports\TeamsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Team;
use App\Game;

class TeamController extends Controller
{
    public function list()
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $filterGame = request()->filterGame;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('team_page')) {
                $page = request()->session()->get('team_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('team_perPage')) {
                $perPage = request()->session()->get('team_perPage');
            }
            if (request()->session()->get('team_order')) {
                $order = request()->session()->get('team_order');
            }
            if (request()->session()->get('team_filterName')) {
                $filterName = request()->session()->get('team_filterName');
            }
            if (request()->session()->get('team_filterGame')) {
                $filterGame = request()->session()->get('team_filterGame');
            }
        }

        $order_ext = $this->getOrder($order);

        $teams = Team::name($filterName)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $teams->lastPage()) {
            $page = $teams->lastPage();
        }
        $teams = Team::name($filterName)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

		$games = Game::orderBy('name')->get();
        if (!$filterGame == 0) {
            $filterGameName = Game::find($filterGame)->name;
        } else {
            $filterGameName = null;
        }

        session(['team_perPage' => $perPage]);
        session(['team_page' => $page]);
        session(['team_order' => $order]);
        session(['team_filterName' => $filterName]);
        session(['team_filterGame' => $filterGame]);

    	return view('admin.teams.list', ['teams' => $teams, 'games' => $games, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterGame' => $filterGame, 'filterGameName' => $filterGameName, 'order' => $order]);
    }

    public function view($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.teams.view', ['team' => $team]);
    }

    public function add()
    {
    	$games = Game::orderBy('name')->get();
        return view('admin.teams.add', ['games' => $games]);
    }

    public function save(Request $request)
    {
    	$game = Game::find($request->game_id);
        $gameName = $game->name;
        $platformName = $game->platform->name;
        $request['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:teams,slug',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => "Ya existe $request->name en el juego $gameName ($platformName)",
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        if ($request->hasFile('img')) {
            $this->validate($request,[
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'img.image' => 'El logo debe ser una imagen',
                'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
            ]);

            $img_name = $data['slug'] . time() . '.' . $request->img->extension();
            \Storage::disk('teams')->put($img_name, \File::get($request->file('img')));

            $data['img'] = $img_name;
        }

        $team = Team::create($data);

        if ($team->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.teams');
        }
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $games = Game::orderBy('name')->get();

        return view('admin.teams.edit', ['team' => $team, 'games' => $games]);
    }

    public function update($id, Request $request)
    {
        $team = Team::findOrFail($id);

    	$game = Game::find($request->game_id);
        $gameName = $game->name;
        $platformName = $game->platform->name;
        $request['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:teams,slug,' . $team->id,
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => "Ya existe $request->name en el juego $gameName ($platformName)",
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('teams')->delete($team->img);
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
                \Storage::disk('teams')->delete($team->img);

	            $img_name = $data['slug'] . time() . '.' . $request->img->extension();
                \Storage::disk('teams')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }
        $team->fill($data);

        if ($team->isDirty()) {
            $team->update($data);
            if ($team->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.teams');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.teams');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.teams');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $team = Team::find($ids[$i]);
            if ($team && $team->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('teams')->delete($team->img);
                $team->delete();
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
            $original = Team::find($ids[$i]);
            if ($original) {
                $counter++;
                $team = $original->replicate();
                $random_numer = rand(100,999);
                $team->name .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = "copy_" . $random_numer . "_" . $original->img;
                    \Storage::disk('teams')->copy($original->img, $img_name);
                    $team->img = $img_name;
                }
                $team->slug = Str::slug($team->name . ' ' . $original->game->name, '-');
                $team->save();
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
        $teams = Team::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new TeamsExport($teams))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new TeamsExport($teams))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new TeamsExport($teams))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $teams = Team::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new TeamsExport($teams))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new TeamsExport($teams))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new TeamsExport($teams))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new TeamsImport, request()->file('fileImport'));
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
