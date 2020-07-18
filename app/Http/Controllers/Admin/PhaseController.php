<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\CompetitionsExport;
use App\Imports\CompetitionsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Phase;
use App\Tournament;
use App\Season;
use App\Competition;

class PhaseController extends Controller
{
    public function list(Tournament $tournament, Season $season, Competition $competition)
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('phase_page')) {
                $page = request()->session()->get('phase_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('phase_perPage')) {
                $perPage = request()->session()->get('phase_perPage');
            }
            if (request()->session()->get('phase_order')) {
                $order = request()->session()->get('phase_order');
            }
            if (request()->session()->get('phase_filterName')) {
                $filterName = request()->session()->get('phase_filterName');
            }
        }

        $order_ext = $this->getOrder($order, $tournament);

        $phases = Phase::competitionId($competition->id)->name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $phases->lastPage()) {
            $page = $phases->lastPage();
        }
		$phases = Phase::competitionId($competition->id)->name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['phase_perPage' => $perPage]);
        session(['phase_page' => $page]);
        session(['phase_order' => $order]);
        session(['phase_filterName' => $filterName]);

    	return view('admin.phases.list', ['phases' => $phases, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, Season $season, Competition $competition, $id)
    {
        $phase = Phase::findOrFail($id);
        return view('admin.phases.view', ['phase' => $phase, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition]);
    }

    public function add(Tournament $tournament, Season $season, Competition $competition)
    {
    	return view('admin.phases.add', ['tournament' => $tournament, 'season' => $season, 'competition' => $competition]);
    }

    public function save(Tournament $tournament, Season $season, Competition $competition, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();

		$data['competition_id'] = $competition->id;
		$data['slug'] = Str::slug($request->name, '-');
		$data['order'] = $competition->phases->count() + 1;
		$data['active'] = 0;

        $phase = Phase::create($data);

        if ($phase->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.phases', [$tournament, $season, $competition]);
        }

    }

    public function edit(Tournament $tournament, Season $season, Competition $competition, $id)
    {
    	$phase = Phase::findOrFail($id);
    	return view('admin.phases.edit', ['phase' => $phase, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition]);
    }

    public function update(Tournament $tournament, Season $season, Competition $competition, $id, Request $request)
    {
    	$phase = Phase::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name, '-');

        $phase->fill($data);

        if ($phase->isDirty()) {
            $phase->update($data);
            if ($phase->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.phases', [$tournament, $season, $competition]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.phases', [$tournament, $season, $competition]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.phases', [$tournament, $season, $competition]);
        }
    }

    public function destroy(Tournament $tournament, Season $season, Competition $competition, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $phase = Phase::find($ids[$i]);
            if ($phase && $phase->canDestroy()) {
                $counter++;
                $phase->delete();
                $this->reorder_phases($competition->id);
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

    protected function reorder_phases($competition_id)
    {
    	$phases = Phase::where('competition_id', '=', $competition_id)->orderBy('order', 'asc')->get();
    	$order = 1;
    	foreach ($phases as $phase) {
    		$phase->order = $order;
    		$phase->save();
    		$order++;
    	}
    }

    public function duplicate(Tournament $tournament, Season $season, Competition $competition, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Phase::find($ids[$i]);
            if ($original) {
                $counter++;
                $phase = $original->replicate();
                $random_numer = rand(100,999);
                $phase->name .= " (copia_" . $random_numer . ")";
                $phase->slug = Str::slug($phase->name, '-');
                $phase->order = $competition->phases->count() + 1;
                $phase->save();
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

    public function export(Tournament $tournament, Season $season, Competition $competition, $format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order, $tournament);
        $competitions = Competition::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $competitions->makeHidden(['img', 'slug']);

        switch ($format) {
            case 'xls':
                return (new CompetitionsExport($competitions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new CompetitionsExport($competitions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new CompetitionsExport($competitions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal(Tournament $tournament, Season $season, Competition $competition, $format, $filename, $order)
    {
        $order_ext = $this->getOrder($order, $tournament);
		$competitions = Competition::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
		$competitions->makeHidden(['img', 'slug']);

        switch ($format) {
            case 'xls':
                return (new CompetitionsExport($competitions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new CompetitionsExport($competitions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new CompetitionsExport($competitions))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new CompetitionsImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }



    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order, $tournament) {
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
