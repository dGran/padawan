@extends('layouts.admin', ['title' => $group->name . ' - Gestión de ligas', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.leagues.standings.breadcrumb')
@endsection

@section('content')
    @include('admin.leagues.standings.content')
@endsection

@section('js')
    @include('admin.leagues.standings.js')
@endsection