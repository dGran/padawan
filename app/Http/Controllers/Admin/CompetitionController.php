<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\CompetitionsExport;
use App\Imports\CompetitionsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Competition;
use App\Tournament;
use App\Season;

class CompetitionController extends Controller
{
	public function selector()
	{
		$tournaments = Tournament::orderBy('name')->get();

		if ($tournaments->count() == 0) {
            flash()->error('No existen torneos, debe existir al menos uno para poder acceder a los participantes');
            return back();
		}

		return view('admin.competitions.selector', ['tournaments' => $tournaments]);
	}

	public function selectorSelect()
	{
		$tournament = Tournament::find(request()->tournament_id);

		if ($tournament && request()->season_slug) {
			return redirect()->route('admin.competitions', [$tournament, request()->season_slug]);
		} else {
			return back();
		}
	}

    public function loadSeasons($tournament_id)
    {
		$seasons = Season::where('tournament_id', '=', $tournament_id)->orderBy('name')->get();

		if ($seasons->count()> 0) {
    		return view('admin.competitions.selector.seasons', ['seasons' => $seasons])->render();
		}
    }

    public function list(Tournament $tournament, Season $season)
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('competition_page')) {
                $page = request()->session()->get('competition_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('competition_perPage')) {
                $perPage = request()->session()->get('competition_perPage');
            }
            if (request()->session()->get('competition_order')) {
                $order = request()->session()->get('competition_order');
            }
            if (request()->session()->get('competition_filterName')) {
                $filterName = request()->session()->get('competition_filterName');
            }
        }

        $order_ext = $this->getOrder($order, $tournament);

        $competitions = Competition::seasonId($season->id)->name($filterName, $tournament)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $competitions->lastPage()) {
            $page = $competitions->lastPage();
        }
		$competitions = Competition::seasonId($season->id)->name($filterName, $tournament)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['competition_perPage' => $perPage]);
        session(['competition_page' => $page]);
        session(['competition_order' => $order]);
        session(['competition_filterName' => $filterName]);

    	return view('admin.competitions.list', ['competitions' => $competitions, 'tournament' => $tournament, 'season' => $season, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, Season $season, $id)
    {
        $competition = Competition::findOrFail($id);
        return view('admin.competitions.view', ['competition' => $competition, 'tournament' => $tournament, 'season' => $season]);
    }

    public function add(Tournament $tournament, Season $season)
    {
    	return view('admin.competitions.add', ['tournament' => $tournament, 'season' => $season]);
    }

    public function save(Tournament $tournament, Season $season, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
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
            if ($request->auto_generate_league == "on" || $request->auto_generate_playoff == "on" || $request->auto_generate_race == "on") {
                if ($request->auto_generate_league == "on") {
                    $this->auto_generate_phase_group_participants($competition, 'league');
                }
                if ($request->auto_generate_playoff == "on") {
                    $this->auto_generate_phase_group_participants($competition, 'playoff');
                }
                if ($request->auto_generate_race == "on") {
                    $this->auto_generate_phase_group_participants($competition, 'race');
                }
                flash()->success('Registro creado correctamente, fase y grupo generados automáticamente e inscritos todos los participantes en el grupo');
                return redirect()->route('admin.competitions', [$tournament, $season]);
            } else {
                flash()->success('Registro creado correctamente');
                return redirect()->route('admin.competitions', [$tournament, $season]);
            }
        }

    }

    public function edit(Tournament $tournament, Season $season, $id)
    {
    	$competition = Competition::findOrFail($id);
    	return view('admin.competitions.edit', ['competition' => $competition, 'tournament' => $tournament, 'season' => $season]);
    }

    public function update(Tournament $tournament, Season $season, $id, Request $request)
    {
    	$competition = Competition::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
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
                return redirect()->route('admin.competitions', [$tournament, $season]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.competitions', [$tournament, $season]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.competitions', [$tournament, $season]);
        }
    }

    public function destroy(Tournament $tournament, Season $season, $ids)
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

    public function duplicate(Tournament $tournament, Season $season, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = Competition::find($ids[$i]);
            if ($original) {
                $counter++;
                $competition = $original->replicate();
                $random_numer = rand(100,999);
                $competition->name .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = "copy_" . $random_numer . "_" . $original->img;
                    \Storage::disk('competitions')->copy($original->img, $img_name);
                    $competition->img = $img_name;
                }
                $competition->slug = Str::slug($competition->name, '-');
                $competition->save();
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

    public function export(Tournament $tournament, Season $season, $format, $ids, $filename, $order)
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

    public function exportGlobal(Tournament $tournament, Season $season, $format, $filename, $order)
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

    protected function auto_generate_phase_group_participants($competition, $mode)
    {
        $phase = \App\Phase::create([
            'competition_id'   => $competition->id,
            'name'             => 'Fase 1',
            'mode'             => $mode,
            'num_participants' => $competition->season->num_participants,
            'order'            => 1,
            'active'           => 0,
            'slug'             => Str::slug('Fase 1', '-')
        ]);
        $group = \App\Group::create([
            'phase_id'         => $phase->id,
            'name'             => 'Grupo 1',
            'num_participants' => $phase->num_participants,
            'active'           => 0,
            'slug'             => Str::slug('Grupo 1', '-')
        ]);
        foreach ($competition->season->participants as $participant) {
            $group_participant = \App\GroupParticipant::create([
                'group_id'       => $group->id,
                'participant_id' => $participant->id
            ]);
        }
        // for ($i=0; $i < $group->num_participants; $i++) {
        //     $participants = \App\Participant::
        //             where('season_id', '=', $competition->season->id)
        //             ->whereNotIn('id', function($query) use ($phase) {
        //                 $query
        //                     ->select('participant_id')
        //                     ->from('groups_participants')
        //                     ->leftJoin('groups', 'groups.id', '=', 'groups_participants.group_id')
        //                     ->leftJoin('phases', 'phases.id', '=', 'groups.phase_id')
        //                     ->whereNotNull('participant_id')
        //                     ->where('phases.id', '=', $phase->id);
        //             })
        //             ->orderBy('id', 'asc')
        //             ->get();

        //     if ($participants->count() > 0) {
        //         foreach ($participants as $participant) {
        //             $group_participant = \App\GroupParticipant::create([
        //                 'group_id'       => $group->id,
        //                 'participant_id' => $participant->id
        //             ]);
        //         }
        //     }
        // }
        switch ($phase->mode) {
            case 'league':
                \App\League::create([
                    'group_id'      => $group->id
                ]);
                break;
            case 'playoff':
                \App\Playoff::create([
                    'group_id'      => $group->id
                ]);
                break;
            case 'race':
                \App\Racing::create([
                    'group_id'      => $group->id
                ]);
                break;
        }
    }
}
