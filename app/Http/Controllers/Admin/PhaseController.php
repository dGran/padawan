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

    	return view('admin.phases.list', ['phases' => $phases, 'tournament' => $tournament, 'season' => $season, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, Season $season, Competition $competition, $id)
    {
        $competition = Competition::findOrFail($id);
        return view('admin.competitions.view', ['competition' => $competition, 'tournament' => $tournament, 'season' => $season]);
    }

    public function add(Tournament $tournament, Season $season, Competition $competition)
    {
    	return view('admin.competitions.add', ['tournament' => $tournament, 'season' => $season]);
    }

    public function save(Tournament $tournament, Season $season, Competition $competition, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El título es obligatorio',
        ]);

        $data = $request->all();

		$data['season_id'] = $season->id;
		$data['slug'] = Str::slug($request->name, '-');
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
            \Storage::disk('competitions')->put($img_name, \File::get($request->file('img')));

            $data['img'] = $img_name;
        }
        $competition = Competition::create($data);

        if ($competition->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.competitions', [$tournament, $season_slug]);
        }

    }

    public function edit(Tournament $tournament, Season $season, Competition $competition, $id)
    {
    	$competition = Competition::findOrFail($id);
    	return view('admin.competitions.edit', ['competition' => $competition, 'tournament' => $tournament, 'season' => $season]);
    }

    public function update(Tournament $tournament, Season $season, Competition $competition, $id, Request $request)
    {
    	$competition = Competition::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El título es obligatorio',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name, '-');
        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('competitions')->delete($competition->img);
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
                \Storage::disk('competitions')->delete($competition->img);

	            $img_name = $data['slug'] . '.' . $request->img->extension();
                \Storage::disk('competitions')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }

        $competition->fill($data);

        if ($competition->isDirty()) {
            $competition->update($data);
            if ($competition->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.competitions', [$tournament, $season_slug]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.competitions', [$tournament, $season_slug]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.competitions', [$tournament, $season_slug]);
        }
    }

    public function destroy(Tournament $tournament, Season $season, Competition $competition, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $competition = Competition::find($ids[$i]);
            if ($competition && $competition->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('competitions')->delete($competition->img);
                $competition->delete();
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

    public function duplicate(Tournament $tournament, Season $season, Competition $competition, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Competition::find($ids[$i]);
            if ($original) {
                $counter++;
                $competitions = $original->replicate();
                $random_numer = rand(100,999);
                $competitions->name .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = "copy_" . $random_numer . "_" . $original->img;
                    \Storage::disk('competitions')->copy($original->img, $img_name);
                    $competitions->img = $img_name;
                }
                $competitions->slug = Str::slug($competitions->name, '-');
                $competitions->save();
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
