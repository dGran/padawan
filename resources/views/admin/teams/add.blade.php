@extends('layouts.admin', ['title' => 'Nuevo equipo', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.teams.add.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.teams.add.content')
@endsection

@section('js')
    @include('admin.teams.add.js')
@endsection