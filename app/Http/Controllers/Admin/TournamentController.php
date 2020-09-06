<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\TournamentsExport;
use App\Imports\TournamentsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Tournament;
use App\Game;

class TournamentController extends Controller
{
    public function list()
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $filterGame = request()->filterGame;
        $filterParticipantType = request()->filterParticipantType;
        $filterMarket = request()->filterMarket == "on" ? 1 : '';
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('tournament_page')) {
                $page = request()->session()->get('tournament_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('tournament_perPage')) {
                $perPage = request()->session()->get('tournament_perPage');
            }
            if (request()->session()->get('tournament_order')) {
                $order = request()->session()->get('tournament_order');
            }
            if (request()->session()->get('tournament_filterName')) {
                $filterName = request()->session()->get('tournament_filterName');
            }
            if (request()->session()->get('tournament_filterGame')) {
                $filterGame = request()->session()->get('tournament_filterGame');
            }
            if (request()->session()->get('tournament_filterParticipantType')) {
                $filterParticipantType = request()->session()->get('tournament_filterParticipantType');
            }
            if (request()->session()->get('tournament_filterMarket')) {
                $filterMarket = request()->session()->get('tournament_filterMarket');
            }
        }

        $order_ext = $this->getOrder($order);

        $tournaments = Tournament::name($filterName)->participantType($filterParticipantType)->game($filterGame)->market($filterMarket)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $tournaments->lastPage()) {
            $page = $tournaments->lastPage();
        }
        $tournaments = Tournament::name($filterName)->participantType($filterParticipantType)->game($filterGame)->market($filterMarket)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        $games = Game::orderBy('name')->get();
        if (!$filterGame == 0) {
            $game = Game::find($filterGame);
            $filterGameName = $game->name . ' (' . $game->platform->name . ')';
        } else {
            $filterGameName = null;
        }

        session(['tournament_perPage' => $perPage]);
        session(['tournament_page' => $page]);
        session(['tournament_order' => $order]);
        session(['tournament_filterName' => $filterName]);
        session(['tournament_filterGame' => $filterGame]);
        session(['tournament_filterParticipantType' => $filterParticipantType]);
        session(['tournament_filterMarket' => $filterMarket]);

    	return view('admin.tournaments.list', ['tournaments' => $tournaments, 'games' => $games, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterParticipantType' => $filterParticipantType, 'filterGame' => $filterGame, 'filterGameName' => $filterGameName, 'filterMarket' => $filterMarket, 'order' => $order]);
    }

    public function view($id)
    {
        $tournament = Tournament::findOrFail($id);
        return view('admin.tournaments.view', ['tournament' => $tournament]);
    }

    public function add()
    {
    	$games = Game::orderBy('name')->get();
        if ($games->count() > 0) {
            return view('admin.tournaments.add', ['games' => $games]);
        } else {
            flash()->error('No existen juegos, debe existir al menos uno para poder crear un nuevo torneo');
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
            'slug' => 'unique:tournaments,slug',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => "Ya existe $request->name en el juego $gameName ($platformName)",
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        if ($request->hasFile('img')) {
            $this->validate($request,[
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'img.image' => 'El logo debe ser una imagen',
                'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes',
                'banner.image' => 'El banner debe ser una imagen',
                'banner.mimes' => 'El banner debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'banner.max' => 'El tamaño del banner no puede ser mayor a 2048 bytes'
            ]);
            $img_name = $data['slug'] . '.' . $request->img->extension();
            \Storage::disk('tournaments')->put($img_name, \File::get($request->file('img')));
            $data['img'] = $img_name;

            $banner_name = 'banner_' . $data['slug'] . '.' . $request->banner->extension();
            \Storage::disk('tournaments')->put($banner_name, \File::get($request->file('banner')));
            $data['banner'] = $banner_name;
        }
        $data['use_teams'] = $request->use_teams == 'on' ? 1 : 0;
        $data['use_rosters'] = $request->use_rosters == 'on' ? 1 : 0;
        $data['use_economy'] = $request->use_economy == 'on' ? 1 : 0;
        $data['use_salaries'] = $request->use_salaries == 'on' ? 1 : 0;
        $data['use_transfers'] = $request->use_transfers == 'on' ? 1 : 0;
        $data['use_clauses'] = $request->use_clauses == 'on' ? 1 : 0;
        $data['use_free_agents'] = $request->use_free_agents == 'on' ? 1 : 0;

        $tournament = Tournament::create($data);

        // quickly confifuration
        if ($request->quickly == "on") {
            $season = \App\Season::create([
                'tournament_id'     => $tournament->id,
                'name'              => 'Temporada 1',
                'state'             => 'inscriptions',
                'num_participants'  => $request->num_participants,
                'slug'              => Str::slug('Temporada 1', '-'),
            ]);
            for ($i = 0; $i < $request->num_participants; $i++) {
                \App\Participant::create([
                    'season_id'     => $season->id
                ]);
            }
            $competition = \App\Competition::create([
                'season_id'         => $season->id,
                'name'              => $tournament->name,
                'slug'              => Str::slug($tournament->name, '-'),
            ]);
            $phase = \App\Phase::create([
                'competition_id'    => $competition->id,
                'name'              => 'Fase 1',
                'mode'              => $request->mode,
                'num_participants'  => $request->num_participants,
                'order'             => 1,
                'active'            => 0,
                'slug'              => Str::slug('Fase 1', '-'),
            ]);
            $group = \App\Group::create([
                'phase_id'          => $phase->id,
                'name'              => 'Grupo 1',
                'num_participants'  => $request->num_participants,
                'active'            => 0,
                'slug'              => Str::slug('Grupo 1', '-'),
            ]);
            foreach ($season->participants as $participant) {
                $group_participant = \App\GroupParticipant::create([
                    'group_id'       => $group->id,
                    'participant_id' => $participant->id
                ]);
            }

            switch ($phase->mode) {
                case 'league':
                    $league = \App\League::create([
                        'group_id'      => $group->id
                    ]);
                    for ($i=1; $i < $group->num_participants+1 ; $i++) {
                        \App\LeagueTablezone::create([
                            'league_id'     => $league->id,
                            'position'      => $i,
                        ]);
                    }
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
                    for ($i=1; $i < $group->num_participants+1 ; $i++) {
                        \App\RacingScore::create([
                            'racing_id'     => $racing->id,
                            'position'      => $i,
                        ]);
                    }
                    break;
            }
        }

        if ($tournament->save()) {
            if ($request->quickly == "on") {
                flash()->success('Registro creado con configuración rápida correctamente');
            } else {
                flash()->success('Registro creado correctamente');
            }
            return redirect()->route('admin.tournaments');
        }
    }

    public function edit($id)
    {
        $tournament = Tournament::findOrFail($id);
        $games = Game::orderBy('name')->get();

        return view('admin.tournaments.edit', ['tournament' => $tournament, 'games' => $games]);
    }

    public function update($id, Request $request)
    {
        $tournament = Tournament::findOrFail($id);

        $game = Game::find($request->game_id);
        $gameName = $game->name;
        $platformName = $game->platform->name;
        $request['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'unique:tournaments,slug,' . $tournament->id,
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'slug.unique'   => "Ya existe $request->name en el juego $gameName ($platformName)",
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name . ' ' . $gameName . ' ' . $platformName, '-');

        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('tournaments')->delete($tournament->img);
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
                \Storage::disk('tournaments')->delete($tournament->img);

	            $img_name = $data['slug'] . time() . '.' . $request->img->extension();
                \Storage::disk('tournaments')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }

        if ($request->deleteBanner) {
            // remove image from Storage
            \Storage::disk('tournaments')->delete($tournament->banner);
            $data['banner'] = null;
        } else {
            if ($request->hasFile('banner')) {
                $this->validate($request,[
                    'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'banner.image' => 'El banner debe ser una imagen',
                    'banner.mimes' => 'El banner debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                    'banner.max' => 'El tamaño del banner no puede ser mayor a 2048 bytes'
                ]);

                // remove image from Storage
                \Storage::disk('tournaments')->delete($tournament->banner);

                $banner_name = 'banner_' . $data['slug'] . time() . '.' . $request->banner->extension();
                \Storage::disk('tournaments')->put($banner_name, \File::get($request->file('banner')));

                $data['banner'] = $banner_name;
            }
        }

        $data['use_teams'] = $request->use_teams == 'on' ? 1 : 0;
        $data['use_rosters'] = $request->use_rosters == 'on' ? 1 : 0;
        $data['use_economy'] = $request->use_economy == 'on' ? 1 : 0;
        $data['use_salaries'] = $request->use_salaries == 'on' ? 1 : 0;
        $data['use_transfers'] = $request->use_transfers == 'on' ? 1 : 0;
        $data['use_clauses'] = $request->use_clauses == 'on' ? 1 : 0;
        $data['use_free_agents'] = $request->use_free_agents == 'on' ? 1 : 0;

        $tournament->fill($data);

        if ($tournament->isDirty()) {
            $tournament->update($data);
            if ($tournament->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.tournaments');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.tournaments');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.tournaments');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $tournament = Tournament::find($ids[$i]);
            if ($tournament && $tournament->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('tournaments')->delete($tournament->img);
                \Storage::disk('tournaments')->delete($tournament->game->banner);
                $tournament->delete();
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
            $original = Tournament::find($ids[$i]);
            if ($original) {
                $counter++;
                $tournament = $original->replicate();
                $random_numer = rand(100,999);
                $tournament->name .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = Str::slug($tournament->name . ' ' . $original->game->name . ' ' . $original->game->platform->name, '-') . '_' . $original->img;
                    \Storage::disk('tournaments')->copy($original->img, $img_name);
                    $tournament->img = $img_name;
                }
                if ($original->banner) {
                    $banner_name = "copy_" . $random_numer . "_" . $original->banner;
                    \Storage::disk('tournaments')->copy($original->banner, $banner_name);
                    $game->banner = $banner_name;
                }
                $tournament->slug = Str::slug($tournament->name . ' ' . $original->game->name . ' ' . $original->game->platform->name, '-');
                $tournament->save();
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
        $tournaments = Tournament::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $tournaments->makeHidden(['img', 'banner', 'rules','slug', 'created_at', 'updated_at']);

        switch ($format) {
            case 'xls':
                return (new TournamentsExport($tournaments))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new TournamentsExport($tournaments))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new TournamentsExport($tournaments))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $tournaments = Tournament::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $tournaments->makeHidden(['img', 'banner', 'rules','slug', 'created_at', 'updated_at']);

        switch ($format) {
            case 'xls':
                return (new TournamentsExport($tournaments))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new TournamentsExport($tournaments))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new TournamentsExport($tournaments))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new TournamentsImport, request()->file('fileImport'));
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

