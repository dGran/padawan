@extends('layouts.admin', ['title' => 'Editar equipo', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.teams.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.teams.edit.content')
@endsection

@section('js')
    @include('admin.teams.edit.js')
@endsection