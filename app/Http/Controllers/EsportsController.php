<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\User;
use App\Game;
use App\ETeam;
use App\ETeamUser;
use App\ETeamRequest;

use App\Events\RequestEteam;

class EsportsController extends Controller
{
    public function index()
    {
    	$filterName = request()->filterName;
    	$filterGame = request()->filterGame;

    	if ($filterGame > 0) {
	    	$game = Game::find($filterGame);
	    	$filterGameName = $game->name . ' - ' . $game->platform->name;
    	} else {
    		$filterGameName = '';
    	}

        $eteams = ETeam::name($filterName)->game($filterGame)->orderBy('name', 'asc')->paginate(12);
    	$games = Game::orderBy('name', 'asc')->get();

        return view('esports.eteams', ['games' => $games, 'eteams' => $eteams, 'filterName' => $filterName, 'filterGame' => $filterGame, 'filterGameName' => $filterGameName]);
    }

    public function eteamAdd()
    {
    	$games = Game::orderBy('name')->get();
    	return view('esports.eteams.add', ['games' => $games]);
    }

    public function eteamStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:eteams',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya está siendo utilizado por otro equipo',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('img')) {
            $this->validate($request,[
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'img.image' => 'El logo debe ser una imagen',
                'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes',
            ]);

            $img_name = $data['slug'] . '.' . $request->img->extension();
            \Storage::disk('eteams')->put($img_name, \File::get($request->file('img')));
            $data['img'] = $img_name;
        }
        $data['owner_id'] = Auth::id();

        $eteam = ETeam::create($data);

        if ($eteam->save()) {
        	$members = ETeamUser::create([
        		'eteam_id'	 => $eteam->id,
				'user_id' 	 => Auth::id(),
        		'admin'      => 1
        	]);
            flash()->success('Equipo creado correctamente');
            return redirect()->route('eteam.admin', $eteam->slug);
        } else {
            flash()->error('Se ha producido un error. El Equipo no se ha creado');
            return redirect()->route('esports');
        }
    }

    public function eteam(ETeam $eteam)
    {
        return view('esports.eteams.eteam.info', ['eteam' => $eteam]);
    }

    public function eteamMembers(ETeam $eteam)
    {
        return view('esports.eteams.eteam.members', ['eteam' => $eteam]);
    }

    public function eteamStats(ETeam $eteam)
    {
        return view('esports.eteams.eteam.stats', ['eteam' => $eteam]);
    }

    public function eteamAdmin(ETeam $eteam)
    {
    // 	$users = User::
	   //      whereNotIn('id', function($query) use ($eteam) {
				// $query
				// 	->select('eplayer_id')
				// 	->from('eteams_players')
				// 	->leftJoin('eplayers', 'eplayers.id', '=', 'eteams_players.eplayer_id')
				// 	->where('eteams_players.eteam_id', '=', $eteam->id);
	   //      })
	   //      ->get();

	   //              ->whereNotIn('id', function($query) use ($phase) {
				// 		$query
				// 			->select('participant_id')
				// 			->from('groups_participants')
				// 			->leftJoin('groups', 'groups.id', '=', 'groups_participants.group_id')
				// 			->leftJoin('phases', 'phases.id', '=', 'groups.phase_id')
				// 			->whereNotNull('participant_id')
				// 			->where('phases.id', '=', $phase->id);
	   //              })
	    // dd($users);
        $requestsReceived = ETeamRequest::where('eteam_id', $eteam->id)->where('send_by', 'user')->where('state', 'pending')->orderBy('created_at', 'desc')->get();
        $requestsSent = ETeamRequest::where('eteam_id', $eteam->id)->where('send_by', 'eteam')->where('state', 'pending')->orderBy('created_at', 'desc')->get();

        return view('esports.eteams.eteam.admin', ['eteam' => $eteam, 'requestsReceived' => $requestsReceived, 'requestsSent' => $requestsSent]);
    }

    public function eteamUserRequest(ETeam $eteam, Request $request)
    {
    	$request = ETeamRequest::create([
    		'eteam_id'	=> $eteam->id,
    		'user_id'	=> Auth::id(),
    		'send_by'	=> 'user',
    		'state'		=> 'pending',
    		'message'	=> $request->message
    	]);

        //message to mailbox to team admins
        event(new RequestEteam($request));

		flash()->success('Solicitud de ingreso enviada');
    	return back();
    }

    public function eteamUserInvitation($user_id)
    {
        $request = ETeamRequest::create([
            'eteam_id'  => $eteam->id,
            'user_id'   => $user_id,
            'send_by'   => 'user',
            'state'     => 'pending',
            'message'   => $request->message
        ]);

        //message to mailbox to team admins
        event(new RequestEteam($request));

        flash()->success('Solicitud de ingreso enviada');
        return back();
    }
}
