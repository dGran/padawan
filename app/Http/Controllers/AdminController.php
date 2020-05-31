<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
    	return view('admin.dashboard');
    }

    public function tournaments()
    {
        $perPage = isset(request()->perPage) ? request()->perPage : 5;
        $page = request()->page;
        $sortField = request()->sortField ? request()->sortField : 'created_at';
        $sortDirection = request()->sortDirection ? request()->sortDirection : 'asc';
        $filterName = request()->filterName;

    	$users = \App\User::name($filterName)->whereNotNull('email_verified_at')->orderBy($sortField, $sortDirection)->Paginate($perPage);

    	return view('admin.tournaments', ['users' => $users, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'sortField' => $sortField, 'sortDirection' => $sortDirection]);
    }
}
