@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras - Calendario - Editar carrera', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.racings.schedule.edit.content')
@endsection

@section('js')
    @include('admin.racings.schedule.edit.js')
@endsection