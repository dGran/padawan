<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\GroupsExport;
use App\Imports\GroupsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Group;
use App\Phase;
use App\Tournament;
use App\Season;
use App\Competition;

class GroupController extends Controller
{
    public function list(Tournament $tournament, Season $season, Competition $competition, Phase $phase)
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

        $groups = Group::phaseId($phase->id)->name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $groups->lastPage()) {
            $page = $groups->lastPage();
        }
		$groups = Group::phaseId($phase->id)->name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['phase_perPage' => $perPage]);
        session(['phase_page' => $page]);
        session(['phase_order' => $order]);
        session(['phase_filterName' => $filterName]);

    	return view('admin.groups.list', ['groups' => $groups, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $id)
    {
        $group = Group::findOrFail($id);
        return view('admin.groups.view', ['group' => $group, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase]);
    }

    public function add(Tournament $tournament, Season $season, Competition $competition, Phase $phase)
    {
    	if ($phase->fullParticipants()) {
            flash()->error('Se ha alcanzado el máximo de participantes de la fase en los grupos existentes');
            return back();
    	} else {
    		return view('admin.groups.add', ['tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase]);
    	}
    }

    public function save(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();

		$data['phase_id'] = $phase->id;
		$data['slug'] = Str::slug($request->name, '-');
		$data['active'] = 0;

        $group = Group::create($data);

        switch ($group->phase->mode) {
            case 'league':
                $league = \App\League::create([
                    'group_id'      => $group->id
                ]);
                break;
            case 'playoff':
                $playoff = \App\Playoff::create([
                    'group_id'      => $group->id
                ]);
                break;
            case 'race':
                $racing = \App\Racing::create([
                    'group_id'      => $group->id
                ]);
                for ($i=0; $i < $group->num_participants ; $i++) {
                    \App\RacingScore::create([
                        'racing_id'     => $racing->id,
                        'position'      => 'Posición ' . $i+1,
                    ]);
                }
                break;
        }

        if ($group->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.groups', [$tournament, $season, $competition, $phase]);
        }

    }

    public function edit(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $id)
    {
    	$group = Group::findOrFail($id);
    	return view('admin.groups.edit', ['group' => $group, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase]);
    }

    public function update(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $id, Request $request)
    {
    	$group = Group::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name, '-');

        $group->fill($data);

        if ($group->isDirty()) {
            $group->update($data);
            if ($group->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.groups', [$tournament, $season, $competition, $phase]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.groups', [$tournament, $season, $competition, $phase]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.groups', [$tournament, $season, $competition, $phase]);
        }
    }

    public function destroy(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $group = Group::find($ids[$i]);
            if ($group && $group->canDestroy()) {
                $counter++;
                $group->delete();
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

    public function duplicate(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Group::find($ids[$i]);
            if ($original) {
                $counter++;
                $group = $original->replicate();
                $random_numer = rand(100,999);
                $group->name .= " (copia_" . $random_numer . ")";
                if ($group->num_participants > $phase->max_participants_new_group()) {
                	$group->num_participants = $phase->max_participants_new_group();
                }
                $group->slug = Str::slug($group->name, '-');
                $group->save();
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

    public function activate(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $group = Group::find($ids[$i]);
            $group->active = 1;
            $group->save();
            $counter++;
        }
        if ($counter > 0) {
            if ($counter == 1) {
                flash()->success('Registro activado correctamente');
            } else {
                flash()->success('Registros activados correctamente');
            }
            return back();
        } else {
            flash()->error('Acción cancelada. Los registros no han podido ser activados.');
            return back();
        }
    }

    public function desactivate(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $group = Group::find($ids[$i]);
            $group->active = 0;
            $group->save();
            $counter++;
        }
        if ($counter > 0) {
            if ($counter == 1) {
                flash()->success('Registro desactivado correctamente');
            } else {
                flash()->success('Registros desactivados correctamente');
            }
            return back();
        } else {
            flash()->error('Acción cancelada. Los registros no han podido ser desactivados.');
            return back();
        }
    }

    public function export(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order, $tournament);
        $groups = Group::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $groups->makeHidden(['slug']);

        switch ($format) {
            case 'xls':
                return (new GroupsExport($groups))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new GroupsExport($groups))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new GroupsExport($groups))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal(Tournament $tournament, Season $season, Competition $competition, Phase $phase, $format, $filename, $order)
    {
        $order_ext = $this->getOrder($order, $tournament);
		$groups = Group::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
		$groups->makeHidden(['slug']);

        switch ($format) {
            case 'xls':
                return (new GroupsExport($groups))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new GroupsExport($groups))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new GroupsExport($groups))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new GroupsImport, request()->file('fileImport'));
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
