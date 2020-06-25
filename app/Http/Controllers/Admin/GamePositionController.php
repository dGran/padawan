<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\PositionsExport;
use App\Imports\PositionsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\GamePosition;
use App\Game;

class GamePositionController extends Controller
{
    public function list()
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'order';
        $filterName = request()->filterName;
        $filterCategory = request()->filterCategory;
        $filterGame = request()->filterGame;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('position_page')) {
                $page = request()->session()->get('position_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('position_perPage')) {
                $perPage = request()->session()->get('position_perPage');
            }
            if (request()->session()->get('position_order')) {
                $order = request()->session()->get('position_order');
            }
            if (request()->session()->get('position_filterName')) {
                $filterName = request()->session()->get('position_filterName');
            }
            if (request()->session()->get('position_filterCategory')) {
                $filterCategory = request()->session()->get('position_filterCategory');
            }
            if (request()->session()->get('position_filterGame')) {
                $filterGame = request()->session()->get('position_filterGame');
            }
        }

        $order_ext = $this->getOrder($order);

        $positions = GamePosition::name($filterName)->category($filterCategory)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $positions->lastPage()) {
            $page = $positions->lastPage();
        }
        $positions = GamePosition::name($filterName)->category($filterCategory)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        $games = Game::where('positions', true)->orderBy('name')->get();
        if (!$filterGame == 0) {
            $game = Game::find($filterGame);
            $filterGameName = $game->name . ' (' . $game->platform->name . ')';
        } else {
            $filterGameName = null;
        }

        session(['position_perPage' => $perPage]);
        session(['position_page' => $page]);
        session(['position_order' => $order]);
        session(['position_filterName' => $filterName]);
        session(['position_filterCategory' => $filterCategory]);
        session(['position_filterGame' => $filterGame]);

    	return view('admin.positions.list', ['positions' => $positions, 'games' => $games, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterCategory' => $filterCategory, 'filterGame' => $filterGame, 'filterGameName' => $filterGameName, 'order' => $order]);
    }

    public function view($id)
    {
        $position = GamePosition::findOrFail($id);
        return view('admin.positions.view', ['position' => $position]);
    }

    public function add()
    {
    	$games = Game::where('positions', true)->orderBy('name')->get();
        if ($games->count() > 0) {
            return view('admin.positions.add', ['games' => $games]);
        } else {
            flash()->error('No existen juegos que admitan posiciones, debe existir al menos uno para poder crear una nueva posición');
            return back();
        }
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'category.required' => 'La categoría es obligatoria',
        ]);

        $data = $request->all();

        $position = GamePosition::create($data);

        if ($position->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.positions');
        }
    }

    public function edit($id)
    {
        $position = GamePosition::findOrFail($id);
        $games = Game::where('positions', true)->orderBy('name')->get();

        return view('admin.positions.edit', ['position' => $position, 'games' => $games]);
    }

    public function update($id, Request $request)
    {
        $position = GamePosition::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'category.required' => 'La categoría es obligatoria',
        ]);

        $data = $request->all();

        $position->fill($data);

        if ($position->isDirty()) {
            $position->update($data);
            if ($position->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.positions');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.positions');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.positions');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $position = GamePosition::find($ids[$i]);
            if ($position && $position->canDestroy()) {
                $counter++;
                $position->delete();
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
            $original = GamePosition::find($ids[$i]);
            if ($original) {
                $counter++;
                $position = $original->replicate();
                $position->name .= " (copia_" . rand(100,999) . ")";
                $position->save();
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
        $positions = GamePosition::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new PositionsExport($positions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PositionsExport($positions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PositionsExport($positions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $positions = GamePosition::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new PositionsExport($positions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PositionsExport($positions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PositionsExport($positions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new PositionsImport, request()->file('fileImport'));
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
            'order' => [
                'sortField'     => 'order',
                'sortDirection' => 'asc'
            ],
            'order_desc' => [
                'sortField'     => 'order',
                'sortDirection' => 'desc'
            ],
            'name' => [
                'sortField'     => 'name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'name',
                'sortDirection' => 'desc'
            ],
            'category' => [
                'sortField'     => 'category',
                'sortDirection' => 'asc'
            ],
            'category_desc' => [
                'sortField'     => 'category',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}
