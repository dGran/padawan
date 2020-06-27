<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
// use App\Exports\TournamentsExport;
// use App\Imports\TournamentsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Tournament;
use App\Season;

class SeasonController extends Controller
{
	public function selector()
	{
		$tournaments = Tournament::select('name', 'slug')->orderBy('name')->get()->toJson();

		return view('admin.seasons.selector', ['tournaments' => $tournaments]);
	}
}
