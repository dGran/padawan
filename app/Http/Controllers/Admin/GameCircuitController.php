<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\CircuitsExport;
use App\Imports\CircuitsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\GameCircuit;
use App\Game;

class GameCircuitController extends Controller
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
            if (request()->session()->get('circuit_page')) {
                $page = request()->session()->get('circuit_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('circuit_perPage')) {
                $perPage = request()->session()->get('circuit_perPage');
            }
            if (request()->session()->get('circuit_order')) {
                $order = request()->session()->get('circuit_order');
            }
            if (request()->session()->get('circuit_filterName')) {
                $filterName = request()->session()->get('circuit_filterName');
            }
            if (request()->session()->get('circuit_filterGame')) {
                $filterGame = request()->session()->get('circuit_filterGame');
            }
        }

        $order_ext = $this->getOrder($order);

        $circuits = GameCircuit::name($filterName)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $circuits->lastPage()) {
            $page = $circuits->lastPage();
        }
        $circuits = GameCircuit::name($filterName)->game($filterGame)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        $games = Game::where('circuits', true)->orderBy('name')->get();
        if (!$filterGame == 0) {
            $game = Game::find($filterGame);
            $filterGameName = $game->name . ' (' . $game->platform->name . ')';
        } else {
            $filterGameName = null;
        }

        session(['circuit_perPage' => $perPage]);
        session(['circuit_page' => $page]);
        session(['circuit_order' => $order]);
        session(['circuit_filterName' => $filterName]);
        session(['circuit_filterGame' => $filterGame]);

    	return view('admin.circuits.list', ['circuits' => $circuits, 'games' => $games, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterGame' => $filterGame, 'filterGameName' => $filterGameName, 'order' => $order]);
    }

    public function view($id)
    {
        $circuit = GameCircuit::findOrFail($id);
        return view('admin.circuits.view', ['circuit' => $circuit]);
    }

    public function add()
    {
    	$games = Game::where('circuits', true)->orderBy('name')->get();
        if ($games->count() > 0) {
            return view('admin.circuits.add', ['games' => $games]);
        } else {
            flash()->error('No existen juegos que admitan circuitos, debe existir al menos uno para poder crear un nuevo circuito');
            return back();
        }
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();

        if ($request->hasFile('img')) {
            $this->validate($request,[
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'img.image' => 'El logo debe ser una imagen',
                'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
            ]);

            $img_name = 'circuit_' . time() . '.' . $request->img->extension();
            \Storage::disk('circuits')->put($img_name, \File::get($request->file('img')));

            $data['img'] = $img_name;
        }

        $circuit = GameCircuit::create($data);

        if ($circuit->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.circuits');
        }
    }

    public function edit($id)
    {
        $circuit = GameCircuit::findOrFail($id);
        $games = Game::where('circuits', true)->orderBy('name')->get();

		return view('admin.circuits.edit', ['circuit' => $circuit, 'games' => $games]);
    }

    public function update($id, Request $request)
    {
        $circuit = GameCircuit::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();

        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('circuits')->delete($circuit->img);
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
                \Storage::disk('circuits')->delete($circuit->img);

	            $img_name = 'circuit_' . time() . '.' . $request->img->extension();
                \Storage::disk('circuits')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }
        $circuit->fill($data);

        if ($circuit->isDirty()) {
            $circuit->update($data);
            if ($circuit->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.circuits');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.circuits');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.circuits');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $circuit = GameCircuit::find($ids[$i]);
            if ($circuit && $circuit->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('circuits')->delete($circuit->img);
                $circuit->delete();
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
            $original = GameCircuit::find($ids[$i]);
            if ($original) {
                $counter++;
                $circuit = $original->replicate();
                $random_numer = rand(100,999);
                $circuit->name .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = "copy_" . $random_numer . "_" . $original->img;
                    \Storage::disk('circuits')->copy($original->img, $img_name);
                    $circuit->img = $img_name;
                }
                $circuit->save();
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
        $circuits = GameCircuit::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new CircuitsExport($circuits))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new CircuitsExport($circuits))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new CircuitsExport($circuits))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $circuits = GameCircuit::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new CircuitsExport($circuits))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new CircuitsExport($circuits))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new CircuitsExport($circuits))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new CircuitsImport, request()->file('fileImport'));
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
