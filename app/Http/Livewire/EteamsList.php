<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
use Illuminate\Support\Str;
use Auth;
use App\User;
use App\Game;
use App\ETeam;
use App\ETeamUser;
use App\ETeamRequest;

class EteamsList extends Component
{
	use WithPagination;

	//filters
	public $filterName;
	public $filterGame = "all";

	// queryString
	protected $queryString = [
		'filterName' => ['except' => ''],
		'filterGame' => ['except' => "all"],
		// 'perPage' => ['except' => '10'],
		// 'order' => ['except' => 'id_desc'],
	];

	public function setFilterGame()
	{
		$this->page = 1;
	}

	public function filterGameName()
	{
		// dd($this->filterGame);
		$game = Game::find($this->filterGame);
		if ($game) {
			return $game->name . ' - ' . $game->platform->name;
		} else {
			return null;
		}
	}

    // Pagination
    public function setPreviousPage()
    {
		$this->page--;
    }

    public function setNextPage()
    {
    	$this->page++;
    }

    public function render()
    {
    	$games = Game::orderBy('name', 'asc')->get();
        // $eteams = ETeam::name($this->filterName)->game($this->filterGame)->orderBy('name', 'asc')->paginate(12);
    	$eteams = ETeam::
    		leftJoin('users', 'users.id', 'eteams.owner_id')
    		->select('eteams.*', 'users.name as owner_name')
    		->name($this->filterName)
    		->game($this->filterGame)
    		->orderBy('name', 'asc')
			->paginate(12)->onEachSide(2);

        return view('esports.eteams_lw', [
        	'games' => $games,
        	'eteams' => $eteams,
        	'filterGameName' => $this->filterGameName(),
        ]);
    }
}
