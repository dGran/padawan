<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ReservesExport;
use App\Imports\ReservesImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Reserve;
use App\Tournament;
use App\Season;
use App\User;
use App\ETeam;

class ReserveController extends Controller
{
	public function selector()
	{
		$tournaments = Tournament::orderBy('name')->get();

		if ($tournaments->count() == 0) {
            flash()->error('No existen torneos, debe existir al menos uno para poder acceder a los participantes');
            return back();
		}

		return view('admin.reserves.selector', ['tournaments' => $tournaments]);
	}

	public function selectorSelect()
	{
		$tournament = Tournament::find(request()->tournament_id);

		if ($tournament && request()->season_slug) {
			return redirect()->route('admin.reserves', [$tournament, request()->season_slug]);
		} else {
			return back();
		}
	}

    public function loadSeasons($tournament_id)
    {
		$seasons = Season::where('tournament_id', '=', $tournament_id)->orderBy('name')->get();

		if ($seasons->count()> 0) {
    		return view('admin.reserves.selector.seasons', ['seasons' => $seasons])->render();
		}
    }

    public function list(Tournament $tournament, $season_slug)
    {
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('reserve_page')) {
                $page = request()->session()->get('reserve_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('reserve_perPage')) {
                $perPage = request()->session()->get('reserve_perPage');
            }
            if (request()->session()->get('reserve_order')) {
                $order = request()->session()->get('reserve_order');
            }
            if (request()->session()->get('reserve_filterName')) {
                $filterName = request()->session()->get('reserve_filterName');
            }
        }

        $order_ext = $this->getOrder($order, $tournament);

        $reserves = Reserve::
        select('reserves.*', 'users.name', 'eteams.name')
        ->leftJoin('users', 'users.id', '=', 'reserves.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'reserves.eteam_id')
        ->seasonId($season->id)
        ->name($filterName, $tournament)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $reserves->lastPage()) {
            $page = $reserves->lastPage();
        }
		$reserves = Reserve::
        select('reserves.*', 'users.name', 'eteams.name')
        ->leftJoin('users', 'users.id', '=', 'reserves.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'reserves.eteam_id')
        ->seasonId($season->id)
        ->name($filterName, $tournament)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['reserve_perPage' => $perPage]);
        session(['reserve_page' => $page]);
        session(['reserve_order' => $order]);
        session(['reserve_filterName' => $filterName]);

    	return view('admin.reserves.list', ['reserves' => $reserves, 'tournament' => $tournament, 'season' => $season, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, $season_slug, $id)
    {
        $reserve = Reserve::findOrFail($id);
        $season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

        return view('admin.reserves.view', ['reserve' => $reserve, 'tournament' => $tournament, 'season' => $season]);
    }

    public function add(Tournament $tournament, $season_slug)
    {
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

    	$users = null;
    	$eteams = null;

    	if ($tournament->participant_type == 'individual') {
	        $users = \DB::table("users")->select('*')
	                ->whereNotIn('id', function($query) use ($season) {
	                   $query->select('user_id')->from('reserves')->whereNotNull('user_id')->where('season_id', '=', $season->id);
	                })
	                ->whereNotIn('id', function($query) use ($season) {
	                   $query->select('user_id')->from('participants')->whereNotNull('user_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    		if ($users->count() == 0) {
	            flash()->error('No existen más usuarios que no sean ya reservas o participantes');
	            return back();
    		}
    	}
    	if ($tournament->participant_type == 'eteam') {
    		$eteams = ETeam::select('*')->orderBy('name')->get();
	        $eteams = \DB::table("eteams")->select('*')
	                ->whereNotIn('id', function($query) use ($season) {
	                   $query->select('eteam_id')->from('reserves')->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
	                })
	                ->whereNotIn('id', function($query) use ($season) {
	                   $query->select('eteam_id')->from('participants')->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    		if ($eteams->count() == 0) {
	            flash()->error('No existen más e-teams que no sean ya reservas o participantes');
	            return back();
    		}
    	}

    	return view('admin.reserves.add', ['tournament' => $tournament, 'season' => $season, 'users' => $users, 'eteams' => $eteams]);
    }

    public function save(Tournament $tournament, $season_slug, Request $request)
    {
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

        $data = $request->all();

		$data['season_id'] = $season->id;
        $reserve = Reserve::create($data);

        if ($reserve->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.reserves', [$tournament, $season_slug]);
        }
    }

    public function edit(Tournament $tournament, $season_slug, $id)
    {
    	$reserve = Reserve::findOrFail($id);
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

    	$users = null;
    	$eteams = null;

    	if ($tournament->participant_type == 'individual') {
	        $users = \DB::table("users")->select('*')
	                ->whereNotIn('id', function($query) use ($season, $reserve) {
	                   $query->select('user_id')->from('reserves')->where('user_id', '!=', $reserve->user_id)->whereNotNull('user_id')->where('season_id', '=', $season->id);
	                })
	                ->whereNotIn('id', function($query) use ($season, $reserve) {
	                   $query->select('user_id')->from('participants')->where('user_id', '!=', $reserve->user_id)->whereNotNull('user_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    	}
    	if ($tournament->participant_type == 'eteam') {
    		$eteams = ETeam::select('*')->orderBy('name')->get();
	        $eteams = \DB::table("eteams")->select('*')
	                ->whereNotIn('id', function($query) use ($season, $reserve) {
	                   $query->select('eteam_id')->from('reserves')->where('eteam_id', '!=', $reserve->eteam_id)->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
	                })
	                ->whereNotIn('id', function($query) use ($season, $reserve) {
	                   $query->select('eteam_id')->from('participants')->where('eteam_id', '!=', $reserve->eteam_id)->whereNotNull('eteam_id')->where('season_id', '=', $season->id);
	                })
	                ->orderBy('name', 'asc')
	                ->get();
    	}

    	return view('admin.reserves.edit', ['reserve' => $reserve, 'tournament' => $tournament, 'season' => $season, 'users' => $users, 'eteams' => $eteams]);
    }

    public function update(Tournament $tournament, $season_slug, $id, Request $request)
    {
    	$reserve = Reserve::findOrFail($id);

        $data = $request->all();
        $reserve->fill($data);

        if ($reserve->isDirty()) {
            $reserve->update($data);
            if ($reserve->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.reserves', [$tournament, $season_slug]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.reserves', [$tournament, $season_slug]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.reserves', [$tournament, $season_slug]);
        }
    }

    public function destroy(Tournament $tournament, $season_slug, $ids)
    {
    	$season = Season::where('tournament_id', $tournament->id)->where('slug', $season_slug)->first();

        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $reserve = Reserve::find($ids[$i]);
            if ($reserve && $reserve->canDestroy()) {
                $counter++;
                $reserve->delete();
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

    public function export(Tournament $tournament, $season_slug, $format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order, $tournament);
        $reserves = Reserve::
        select('reserves.*', 'users.name', 'eteams.name')
        ->leftJoin('users', 'users.id', '=', 'reserves.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'reserves.eteam_id')
        ->whereIn('reserves.id', $ids)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new ReservesExport($reserves))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new ReservesExport($reserves))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new ReservesExport($reserves))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal(Tournament $tournament, $season_slug, $format, $filename, $order) {
        $order_ext = $this->getOrder($order, $tournament);
        $reserves = Reserve::
        select('reserves.*', 'users.name', 'eteams.name')
        ->leftJoin('users', 'users.id', '=', 'reserves.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'reserves.eteam_id')
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new ReservesExport($reserves))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new ReservesExport($reserves))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new ReservesExport($reserves))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new ReservesImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }



    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order, $tournament) {
        if ($tournament->participant_type == "individual") {
        	$name_field = "users.name";
        } else {
        	$name_field = "eteams.name";
        }
        $order_ext = [
            'id' => [
                'sortField'     => 'reserves.id',
                'sortDirection' => 'asc'
            ],
            'id_desc' => [
                'sortField'     => 'reserves.id',
                'sortDirection' => 'desc'
            ],
            'name' => [
                'sortField'     => $name_field,
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => $name_field,
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}
