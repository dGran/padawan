<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\PlayersDatabasesExport;
use App\Imports\PlayersDatabasesImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\PlayerDatabase;
use App\Game;

class PlayerDatabaseController extends Controller
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
            if (request()->session()->get('player_database_page')) {
                $page = request()->session()->get('player_database_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('player_database_perPage')) {
                $perPage = request()->session()->get('player_database_perPage');
            }
            if (request()->session()->get('player_database_order')) {
                $order = request()->session()->get('player_database_order');
            }
            if (request()->session()->get('player_database_filterName')) {
                $filterName = request()->session()->get('player_database_filterName');
            }
            if (request()->session()->get('player_database_filterGame')) {
                $filterGame = request()->session()->get('player_database_filterGame');
            }
        }

        $order_ext = $this->getOrder($order);

        $players_databases = PlayerDatabase::name($filterName)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $players_databases->lastPage()) {
            $page = $players_databases->lastPage();
        }
        $players_databases = PlayerDatabase::name($filterName)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        $games = Game::where('rosters', true)->orderBy('name')->get();
        if (!$filterGame == 0) {
        	$game = Game::find($filterGame);
            $filterGameName = $game->name . ' (' . $game->platform->name . ')';
        } else {
            $filterGameName = null;
        }

        session(['player_database_perPage' => $perPage]);
        session(['player_database_page' => $page]);
        session(['player_database_order' => $order]);
        session(['player_database_filterName' => $filterName]);
        session(['player_database_filterGame' => $filterGame]);

    	return view('admin.players_databases.list', ['players_databases' => $players_databases, 'games' => $games, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterGame' => $filterGame, 'filterGameName' => $filterGameName, 'order' => $order]);
    }

    public function view($id)
    {
        $player_database = PlayerDatabase::findOrFail($id);
        return view('admin.players_databases.view', ['player_database' => $player_database]);
    }

    public function add()
    {
    	$games = Game::where('rosters', true)->orderBy('name')->get();
        if ($games->count() > 0) {
            return view('admin.players_databases.add', ['games' => $games]);
        } else {
            flash()->error('No existen juegos que admitan plantillas de jugadores, debe existir al menos uno para poder crear una nueva database');
            return back();
        }
    }

    public function save(Request $request)
    {
    	$game = Game::find($request->game_id);
        $gameName = $game->name;
        $platformName = $game->platform->name;
        $request['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:players_databases,slug',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => "Ya existe $request->name en el juego $gameName ($platformName)",
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $player_database = PlayerDatabase::create($data);

        if ($player_database->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.players_databases');
        }
    }

    public function edit($id)
    {
        $player_database = PlayerDatabase::findOrFail($id);
        $games = Game::where('rosters', true)->orderBy('name')->get();

        return view('admin.players_databases.edit', ['player_database' => $player_database, 'games' => $games]);
    }

    public function update($id, Request $request)
    {
        $player_database = PlayerDatabase::findOrFail($id);

    	$game = Game::find($request->game_id);
        $gameName = $game->name;
        $platformName = $game->platform->name;
        $request['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:players_databases,slug,' . $player_database->id,
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => "Ya existe $request->name en el juego $gameName ($platformName)",
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $player_database->fill($data);

        if ($player_database->isDirty()) {
            $player_database->update($data);
            if ($player_database->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.players_databases');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.players_databases');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.players_databases');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $player_database = PlayerDatabase::find($ids[$i]);
            if ($player_database && $player_database->canDestroy()) {
                $counter++;
                $player_database->delete();
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
            $original = PlayerDatabase::find($ids[$i]);
            if ($original) {
                $counter++;
                $player_database = $original->replicate();
                $random_numer = rand(100,999);
                $player_database->name .= " (copia_" . $random_numer . ")";
                $player_database->slug = Str::slug($player_database->name . ' ' . $original->game->name  . ' ' . $original->game->platform->name, '-');
                $player_database->save();
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
        $players_databases = PlayerDatabase::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new PlayersDatabasesExport($players_databases))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PlayersDatabasesExport($players_databases))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PlayersDatabasesExport($players_databases))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $players_databases = PlayerDatabase::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new PlayersDatabasesExport($players_databases))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PlayersDatabasesExport($players_databases))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PlayersDatabasesExport($players_databases))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new PlayersDatabasesImport, request()->file('fileImport'));
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
