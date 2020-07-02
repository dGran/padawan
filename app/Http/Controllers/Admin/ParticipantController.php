<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
// use App\Exports\SeasonsExport;
// use App\Imports\SeasonsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Participant;

class ParticipantController extends Controller
{
	public function selector()
	{
        flash()->info('En desarrollo...');
        return back();
	}

	public function list()
	{
        flash()->info('En desarrollo...');
        return back();
	}
}
