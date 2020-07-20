<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\GroupsParticipantsExport;
use App\Imports\GroupsParticipantsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\GroupParticipant;
use App\Participant;
use App\Group;
use App\Phase;
use App\Tournament;
use App\Season;
use App\Competition;

class GroupParticipantController extends Controller
{
    public function list(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('group_participant_page')) {
                $page = request()->session()->get('group_participant_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('group_participant_perPage')) {
                $perPage = request()->session()->get('group_participant_perPage');
            }
            if (request()->session()->get('group_participant_order')) {
                $order = request()->session()->get('group_participant_order');
            }
            if (request()->session()->get('group_participant_filterName')) {
                $filterName = request()->session()->get('group_participant_filterName');
            }
        }

        $order_ext = $this->getOrder($order, $tournament);

        // $groups_participants = GroupParticipant::groupId($group->id)->name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        $groups_participants = GroupParticipant::
        select('groups_participants.*', 'teams.name', 'users.name', 'eteams.name')
        ->leftJoin('participants', 'participants.id', '=', 'groups_participants.participant_id')
        ->leftJoin('teams', 'teams.id', '=', 'participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'participants.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'participants.eteam_id')
        ->groupId($group->id)
        ->name($filterName)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $groups_participants->lastPage()) {
            $page = $groups_participants->lastPage();
        }
        $groups_participants = GroupParticipant::
        select('groups_participants.*', 'teams.name', 'users.name', 'eteams.name')
        ->leftJoin('participants', 'participants.id', '=', 'groups_participants.participant_id')
        ->leftJoin('teams', 'teams.id', '=', 'participants.team_id')
        ->leftJoin('users', 'users.id', '=', 'participants.user_id')
        ->leftJoin('eteams', 'eteams.id', '=', 'participants.eteam_id')
        ->groupId($group->id)
        ->name($filterName)
        ->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);
		// $groups_participants = GroupParticipant::groupId($group->id)->name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['group_participant_perPage' => $perPage]);
        session(['group_participant_page' => $page]);
        session(['group_participant_order' => $order]);
        session(['group_participant_filterName' => $filterName]);

    	return view('admin.groups_participants.list', ['groups_participants' => $groups_participants, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id)
    {
        $group_participant = GroupParticipant::findOrFail($id);
        return view('admin.groups.view', ['group_participant' => $group_participant, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group]);
    }

    public function add(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group)
    {
   		if ($group->fullParticipants()) {
            flash()->error('Se ha alcanzado el máximo de participantes');
            return back();
    	} else {
	        $participants = Participant::
	        		where('season_id', '=', $season->id)
	                ->whereNotIn('id', function($query) use ($phase) {
						$query
							->select('participant_id')
							->from('groups_participants')
							->leftJoin('groups', 'groups.id', '=', 'groups_participants.group_id')
							->leftJoin('phases', 'phases.id', '=', 'groups.phase_id')
							->whereNotNull('participant_id')
							->where('phases.id', '=', $phase->id);
	                })
	                ->orderBy('id', 'asc')
	                ->get();
    		if ($participants->count() == 0) {
	            flash()->error('No existen más participantes');
	            return back();
    		}

    		return view('admin.groups_participants.add', ['tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group, 'participants' => $participants]);
    	}
    }

    public function save(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, Request $request)
    {
        $data = $request->all();
		$data['group_id'] = $group->id;

        $group_participant = GroupParticipant::create($data);
        if ($group_participant->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.groups_participants', [$tournament, $season, $competition, $phase, $group]);
        }
    }

    public function edit(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id)
    {
    	$group_participant = GroupParticipant::findOrFail($id);
        $participants = Participant::
        		where('season_id', '=', $season->id)
                ->whereNotIn('id', function($query) use ($phase, $group_participant) {
					$query
						->select('participant_id')
						->from('groups_participants')
						->where('participant_id', '!=', $group_participant->participant_id)
						->leftJoin('groups', 'groups.id', '=', 'groups_participants.group_id')
						->leftJoin('phases', 'phases.id', '=', 'groups.phase_id')
						->whereNotNull('participant_id')
						->where('phases.id', '=', $phase->id);
                })
                ->orderBy('id', 'asc')
                ->get();

    	return view('admin.groups_participants.edit', ['group_participant' => $group_participant, 'tournament' => $tournament, 'season' => $season, 'competition' => $competition, 'phase' => $phase, 'group' => $group, 'participants' => $participants]);
    }

    public function update(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $id, Request $request)
    {
    	$group_participant = GroupParticipant::findOrFail($id);

        // $data = $request->validate([
        //     'name' => 'required',
        // ],
        // [
        //     'name.required' => 'El nombre es obligatorio',
        // ]);

        $data = $request->all();

        $group_participant->fill($data);

        if ($group_participant->isDirty()) {
            $group_participant->update($data);
            if ($group_participant->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.groups_participants', [$tournament, $season, $competition, $phase, $group]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.groups_participants', [$tournament, $season, $competition, $phase, $group]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.groups_participants', [$tournament, $season, $competition, $phase, $group]);
        }
    }

    public function destroy(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $group_participant = GroupParticipant::find($ids[$i]);
            if ($group_participant && $group_participant->canDestroy()) {
                $counter++;
                $group_participant->delete();
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

    public function export(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order, $tournament);
        $groups_participants = GroupParticipant::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new GroupsParticipantsExport($groups_participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new GroupsParticipantsExport($groups_participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new GroupsParticipantsExport($groups_participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal(Tournament $tournament, Season $season, Competition $competition, Phase $phase, Group $group, $format, $filename, $order)
    {
        $order_ext = $this->getOrder($order, $tournament);
		$groups_participants = GroupParticipant::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new GroupsParticipantsExport($groups_participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new GroupsParticipantsExport($groups_participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new GroupsParticipantsExport($groups_participants))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new GroupsParticipantsImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }



    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order, $tournament) {
        if ($tournament->use_teams) {
        	$name_field = "teams.name";
        } else {
            if ($tournament->participant_type == "individual") {
            	$name_field = "users.name";
            } else {
            	$name_field = "eteams.name";
            }
        }
        $order_ext = [
            'id' => [
                'sortField'     => 'groups_participants.id',
                'sortDirection' => 'asc'
            ],
            'id_desc' => [
                'sortField'     => 'groups_participants.id',
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
