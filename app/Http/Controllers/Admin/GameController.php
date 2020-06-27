<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\GamesExport;
use App\Imports\GamesImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Game;
use App\Platform;

class GameController extends Controller
{
    public function list()
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $filterPlatform = request()->filterPlatform;
        $filterOnlyModeLeague = request()->filterOnlyModeLeague == "on" ? 1 : '';
        $filterOnlyModePlayoffs = request()->filterOnlyModePlayoffs == "on" ? 1 : '';
        $filterOnlyModeRaces = request()->filterOnlyModeRaces == "on" ? 1 : '';
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('game_page')) {
                $page = request()->session()->get('game_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('game_perPage')) {
                $perPage = request()->session()->get('game_perPage');
            }
            if (request()->session()->get('game_order')) {
                $order = request()->session()->get('game_order');
            }
            if (request()->session()->get('game_filterName')) {
                $filterName = request()->session()->get('game_filterName');
            }
            if (request()->session()->get('user_filterPlatform')) {
                $filterPlatform = request()->session()->get('user_filterPlatform');
            }
            if (request()->session()->get('user_filterOnlyModeLeague')) {
                $filterOnlyModeLeague = request()->session()->get('user_filterOnlyModeLeague');
            }
            if (request()->session()->get('user_filterOnlyModePlayoffs')) {
                $filterOnlyModePlayoffs = request()->session()->get('user_filterOnlyModePlayoffs');
            }
            if (request()->session()->get('user_filterOnlyModeRaces')) {
                $filterOnlyModeRaces = request()->session()->get('user_filterOnlyModeRaces');
            }
        }

        $order_ext = $this->getOrder($order);

        $games = Game::name($filterName)->platform($filterPlatform)->onlyModeLeague($filterOnlyModeLeague)->onlyModePlayoffs($filterOnlyModePlayoffs)->onlyModeRaces($filterOnlyModeRaces)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $games->lastPage()) {
            $page = $games->lastPage();
        }
        $games = Game::name($filterName)->platform($filterPlatform)->onlyModeLeague($filterOnlyModeLeague)->onlyModePlayoffs($filterOnlyModePlayoffs)->onlyModeRaces($filterOnlyModeRaces)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        $platforms = Platform::orderBy('name')->get();
        if (!$filterPlatform == 0) {
            $filterPlatformName = Platform::find($filterPlatform)->name;
        } else {
            $filterPlatformName = null;
        }

        session(['game_perPage' => $perPage]);
        session(['game_page' => $page]);
        session(['game_order' => $order]);
        session(['game_filterName' => $filterName]);
        session(['game_filterPlatform' => $filterPlatform]);
        session(['user_filterOnlyModeLeague' => $filterOnlyModeLeague]);
        session(['user_filterOnlyModePlayoffs' => $filterOnlyModePlayoffs]);
        session(['user_filterOnlyModeRaces' => $filterOnlyModeRaces]);

    	return view('admin.games.list', ['games' => $games, 'platforms' => $platforms, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterPlatform' => $filterPlatform, 'filterPlatformName' => $filterPlatformName, 'filterOnlyModeLeague' => $filterOnlyModeLeague, 'filterOnlyModePlayoffs' => $filterOnlyModePlayoffs, 'filterOnlyModeRaces' => $filterOnlyModeRaces, 'order' => $order]);
    }

    public function view($id)
    {
        $game = Game::findOrFail($id);
        return view('admin.games.view', ['game' => $game]);
    }

    public function add()
    {
        $platforms = Platform::orderBy('name')->get();
        if ($platforms->count() > 0) {
            return view('admin.games.add', ['platforms' => $platforms]);
        } else {
            flash()->error('No existen plataformas, debe existir al menos una para poder crear un nuevo juego');
            return back();
        }
    }

    public function save(Request $request)
    {
        $platformName = Platform::find($request->platform_id)->name;
        $request['slug'] = Str::slug($request->name . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:games,slug',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => 'Ya existe ' . $request->name . ' en la plataforma ' . $platformName,
        ]);

        $data = $request->all();

        $platformName = Platform::find($request->platform_id)->name;
        $data['slug'] = Str::slug($request->name . ' ' . $platformName, '-');

        if ($request->hasFile('img')) {
            $this->validate($request,[
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'img.image' => 'El logo debe ser una imagen',
                'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
            ]);

            $img_name = $data['slug'] . '.' . $request->img->extension();
            \Storage::disk('games')->put($img_name, \File::get($request->file('img')));

            $data['img'] = $img_name;
        }
        $data['mode_league'] = $request->mode_league == 'on' ? 1 : 0;
        $data['mode_playoffs'] = $request->mode_playoffs == 'on' ? 1 : 0;
        $data['mode_races'] = $request->mode_races == 'on' ? 1 : 0;
        $data['rosters'] = $request->rosters == 'on' ? 1 : 0;
        $data['positions'] = $request->positions == 'on' ? 1 : 0;
        $data['circuits'] = $request->circuits == 'on' ? 1 : 0;

        $game = Game::create($data);

        if ($game->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.games');
        }
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $platforms = Platform::orderBy('name')->get();

        return view('admin.games.edit', ['game' => $game, 'platforms' => $platforms]);
    }

    public function update($id, Request $request)
    {
        $game = Game::findOrFail($id);

        $platformName = Platform::find($request->platform_id)->name;
        $request['slug'] = Str::slug($request->name . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:games,slug,' . $game->id,
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => 'Ya existe ' . $request->name . ' en la plataforma ' . $platformName,
        ]);

        $data = $request->all();

        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('games')->delete($game->img);
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
                \Storage::disk('games')->delete($game->img);

	            $img_name = $data['slug'] . '.' . $request->img->extension();
                \Storage::disk('games')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }
        $data['mode_league'] = $request->mode_league == 'on' ? 1 : 0;
        $data['mode_playoffs'] = $request->mode_playoffs == 'on' ? 1 : 0;
        $data['mode_races'] = $request->mode_races == 'on' ? 1 : 0;
        $data['rosters'] = $request->rosters == 'on' ? 1 : 0;
        $data['positions'] = $request->positions == 'on' ? 1 : 0;
        $data['circuits'] = $request->circuits == 'on' ? 1 : 0;

        $game->fill($data);

        if ($game->isDirty()) {
            $game->update($data);
            if ($game->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.games');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.games');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.games');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $game = Game::find($ids[$i]);
            if ($game && $game->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('games')->delete($game->img);
                $game->delete();
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
            $original = Game::find($ids[$i]);
            if ($original) {
                $counter++;
                $game = $original->replicate();
                $random_numer = rand(100,999);
                $game->name .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = "copy_" . $random_numer . "_" . $original->img;
                    \Storage::disk('games')->copy($original->img, $img_name);
                    $game->img = $img_name;
                }
                $game->slug = Str::slug($game->name . ' ' . $original->platform->name, '-');
                $game->save();
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
        $games = Game::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $games->makeHidden(['img', 'slug']);

        switch ($format) {
            case 'xls':
                return (new GamesExport($games))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new GamesExport($games))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new GamesExport($games))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $games = Game::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $games->makeHidden(['img', 'slug']);

        switch ($format) {
            case 'xls':
                return (new GamesExport($games))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new GamesExport($games))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new GamesExport($games))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new GamesImport, request()->file('fileImport'));
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