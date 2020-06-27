<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\PlayersExport;
use App\Imports\PlayersImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Player;
use App\PlayerDatabase;
use App\GamePosition;

class PlayerController extends Controller
{
    public function list()
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $filterPlayerDatabase = request()->filterPlayerDatabase;
        $filterNation = request()->filterNation;
        $filterTeam = request()->filterTeam;
        $filterLeague = request()->filterLeague;
        $filterGameID = request()->filterGameID;
        $filterFoot = request()->filterFoot;
        $filterPosition = request()->filterPosition;
		$filterOverallRangeFrom = null;
    	$filterOverallRangeTo = null;
    	if (request()->filterOverallRange) {
    		if (request()->filterOverallRange != "50;50") {
		    	$overall_rating = (explode( ';', request()->filterOverallRange));
		    	$filterOverallRangeFrom = $overall_rating[0];
		    	$filterOverallRangeTo = $overall_rating[1];
    		}
    	}
		$filterAgeRangeFrom = null;
    	$filterAgeRangeTo = null;
    	if (request()->filterAgeRange) {
    		if (request()->filterAgeRange != "15;15") {
		    	$age_rating = (explode( ';', request()->filterAgeRange));
		    	$filterAgeRangeFrom = $age_rating[0];
		    	$filterAgeRangeTo = $age_rating[1];
    		}
    	}
		$filterHeightRangeFrom = null;
    	$filterHeightRangeTo = null;
    	if (request()->filterHeightRange) {
    		if (request()->filterHeightRange != "150;150") {
		    	$height_rating = (explode( ';', request()->filterHeightRange));
		    	$filterHeightRangeFrom = $height_rating[0];
		    	$filterHeightRangeTo = $height_rating[1];
    		}
    	}
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('player_page')) {
                $page = request()->session()->get('player_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('player_perPage')) {
                $perPage = request()->session()->get('player_perPage');
            }
            if (request()->session()->get('player_order')) {
                $order = request()->session()->get('player_order');
            }
            if (request()->session()->get('player_filterName')) {
                $filterName = request()->session()->get('player_filterName');
            }
            if (request()->session()->get('player_filterPlayerDatabase')) {
                $filterPlayerDatabase = request()->session()->get('player_filterPlayerDatabase');
            }
            if (request()->session()->get('player_filterTeam')) {
                $filterTeam = request()->session()->get('player_filterTeam');
            }
            if (request()->session()->get('player_filterNation')) {
                $filterNation = request()->session()->get('player_filterNation');
            }
            if (request()->session()->get('player_filterLeague')) {
                $filterLeague = request()->session()->get('player_filterLeague');
            }
            if (request()->session()->get('player_filterGameID')) {
                $filterGameID = request()->session()->get('player_filterGameID');
            }
            if (request()->session()->get('player_filterFoot')) {
                $filterFoot = request()->session()->get('player_filterFoot');
            }
            if (request()->session()->get('player_filterPosition')) {
                $filterPosition = request()->session()->get('player_filterPosition');
            }
            if (request()->session()->get('player_filterOverallRangeFrom')) {
                $filterOverallRangeFrom = request()->session()->get('player_filterOverallRangeFrom');
            }
            if (request()->session()->get('player_filterOverallRangeTo')) {
                $filterOverallRangeTo = request()->session()->get('player_filterOverallRangeTo');
            }
            if (request()->session()->get('player_filterAgeRangeFrom')) {
                $filterAgeRangeFrom = request()->session()->get('player_filterAgeRangeFrom');
            }
            if (request()->session()->get('player_filterAgeRangeTo')) {
                $filterAgeRangeTo = request()->session()->get('player_filterAgeRangeTo');
            }
            if (request()->session()->get('player_filterHeightRangeFrom')) {
                $filterHeightRangeFrom = request()->session()->get('player_filterHeightRangeFrom');
            }
            if (request()->session()->get('player_filterHeightRangeTo')) {
                $filterHeightRangeTo = request()->session()->get('player_filterHeightRangeTo');
            }
        }

        $order_ext = $this->getOrder($order);

        $players = Player::name($filterName)->playerDatabase($filterPlayerDatabase)->team($filterTeam)->nation($filterNation)->league($filterLeague)->position($filterPosition)->overallRange($filterOverallRangeFrom, $filterOverallRangeTo)->ageRange($filterAgeRangeFrom, $filterAgeRangeTo)->heightRange($filterHeightRangeFrom, $filterHeightRangeTo)->gameID($filterGameID)->foot($filterFoot)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $players->lastPage()) {
            $page = $players->lastPage();
        }
        $players = Player::name($filterName)->playerDatabase($filterPlayerDatabase)->team($filterTeam)->nation($filterNation)->league($filterLeague)->position($filterPosition)->overallRange($filterOverallRangeFrom, $filterOverallRangeTo)->ageRange($filterAgeRangeFrom, $filterAgeRangeTo)->heightRange($filterHeightRangeFrom, $filterHeightRangeTo)->gameID($filterGameID)->foot($filterFoot)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

		$players_databases = PlayerDatabase::orderBy('name')->get();
		$positions = GamePosition::orderBy('name')->get();

        if (!$filterPlayerDatabase == 0) {
            $player_database = PlayerDatabase::find($filterPlayerDatabase);
            $filterPlayerDatabaseName = $player_database->name . ' (' . $player_database->game->name . ' - ' . $player_database->game->platform->name . ')';
        } else {
            $filterPlayerDatabaseName = null;
        }
        if (!$filterPosition == 0) {
            $position = GamePosition::find($filterPosition);
            $filterPositionName = $position->name;
        } else {
            $filterPositionName = null;
        }

        session(['player_perPage' => $perPage]);
        session(['player_page' => $page]);
        session(['player_order' => $order]);
        session(['player_filterName' => $filterName]);
        session(['player_filterPlayerDatabase' => $filterPlayerDatabase]);
        session(['player_filterTeam' => $filterTeam]);
        session(['player_filterNation' => $filterNation]);
        session(['player_filterLeague' => $filterLeague]);
        session(['player_filterPosition' => $filterPosition]);
        session(['player_filterGameID' => $filterGameID]);
        session(['player_filterFoot' => $filterFoot]);
        session(['player_filterOverallRangeFrom' => $filterOverallRangeFrom]);
        session(['player_filterOverallRangeTo' => $filterOverallRangeTo]);
		session(['player_filterAgeRangeFrom' => $filterAgeRangeFrom]);
        session(['player_filterAgeRangeTo' => $filterAgeRangeTo]);
		session(['player_filterHeightRangeFrom' => $filterHeightRangeFrom]);
        session(['player_filterHeightRangeTo' => $filterHeightRangeTo]);

    	return view('admin.players.list', ['players' => $players, 'players_databases' => $players_databases, 'positions' => $positions, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterPlayerDatabase' => $filterPlayerDatabase, 'filterTeam' => $filterTeam, 'filterNation' => $filterNation, 'filterLeague' => $filterLeague, 'filterPosition' => $filterPosition, 'filterPlayerDatabaseName' => $filterPlayerDatabaseName, 'filterPositionName' => $filterPositionName, 'filterOverallRangeFrom' => $filterOverallRangeFrom, 'filterOverallRangeTo' => $filterOverallRangeTo, 'filterAgeRangeFrom' => $filterAgeRangeFrom, 'filterAgeRangeTo' => $filterAgeRangeTo, 'filterHeightRangeFrom' => $filterHeightRangeFrom, 'filterHeightRangeTo' => $filterHeightRangeTo, 'filterGameID' => $filterGameID, 'filterFoot' => $filterFoot, 'order' => $order]);
    }

    public function view($id)
    {
        $player = Player::findOrFail($id);
        return view('admin.players.view', ['player' => $player]);
    }

    public function loadPositions($player_database_id, $mode, $player_position_id = null)
    {
		$player_database = PlayerDatabase::find($player_database_id);
		$positions = GamePosition::where('game_id', '=', $player_database->game->id)->orderBy('order')->get();

		if ($mode == 'add') {
        	return view('admin.players.add.positions', ['positions' => $positions])->render();
		}

		if ($mode == 'edit') {
        	return view('admin.players.edit.positions', ['positions' => $positions, 'player_position_id' => $player_position_id])->render();
		}

		if ($mode == 'list') {
        	return view('admin.players.list.positions', ['positions' => $positions, 'player_position_id' => $player_position_id])->render();
		}
    }

    public function add()
    {
    	$players_databases = PlayerDatabase::orderBy('name')->get();
    	if ($players_databases->count() > 0) {
        	return view('admin.players.add', ['players_databases' => $players_databases]);
    	} else {
    		flash()->error('No existen databases, debe existir al menos una para poder crear un nuevo jugador');
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
                'img.image' => 'La imagen debe ser una imagen',
                'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes'
            ]);

            $img_name = Str::slug($data['name'], '-') . time() . '.' . $request->img->extension();
            \Storage::disk('players')->put($img_name, \File::get($request->file('img')));

            $data['img'] = $img_name;
        }

        $player = Player::create($data);

        if ($player->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.players');
        }
    }

    public function edit($id)
    {
        $player = Player::findOrFail($id);
		$players_databases = PlayerDatabase::orderBy('name')->get();

        return view('admin.players.edit', ['player' => $player, 'players_databases' => $players_databases]);
    }

    public function update($id, Request $request)
    {
        $player = Player::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
        ]);

        $data = $request->all();

        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('players')->delete($player->img);
            $data['img'] = null;
        } else {
            if ($request->hasFile('img')) {
                $this->validate($request,[
                    'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'img.image' => 'La imagen debe ser una imagen',
                    'img.mimes' => 'La imagen debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                    'img.max' => 'El tamaño de la imagen no puede ser mayor a 2048 bytes'
                ]);

                // remove image from Storage
                \Storage::disk('players')->delete($player->img);

	            $img_name = Str::slug($data['name'], '-') . time() . '.' . $request->img->extension();
                \Storage::disk('players')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }
        $player->fill($data);

        if ($player->isDirty()) {
            $player->update($data);
            if ($player->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.players');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.players');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.players');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $player = Player::find($ids[$i]);
            if ($player && $player->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('players')->delete($player->img);
                $player->delete();
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
            $original = Player::find($ids[$i]);
            if ($original) {
                $counter++;
                $player = $original->replicate();
                $random_numer = rand(100,999);
                $player->name .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = "copy_" . $random_numer . "_" . $original->img;
                    \Storage::disk('players')->copy($original->img, $img_name);
                    $player->img = $img_name;
                }
                $player->save();
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
        $players = Player::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $players->makeHidden(['img']);

        switch ($format) {
            case 'xls':
                return (new PlayersExport($players))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PlayersExport($players))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PlayersExport($players))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $players = Player::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $players->makeHidden(['img']);

        switch ($format) {
            case 'xls':
                return (new PlayersExport($players))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PlayersExport($players))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PlayersExport($players))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new PlayersImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }


    /*
     * HELPERS FUNCTIONSS
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
            'overall' => [
                'sortField'     => 'overall_rating',
                'sortDirection' => 'asc'
            ],
            'overall_desc' => [
                'sortField'     => 'overall_rating',
                'sortDirection' => 'desc'
            ],
            'age' => [
                'sortField'     => 'age',
                'sortDirection' => 'asc'
            ],
            'age_desc' => [
                'sortField'     => 'age',
                'sortDirection' => 'desc'
            ],
            'height' => [
                'sortField'     => 'height',
                'sortDirection' => 'asc'
            ],
            'height_desc' => [
                'sortField'     => 'height',
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
