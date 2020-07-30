@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras - Calendario - Resultados carrera', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.results.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.racings.schedule.results.content')
@endsection

@section('js')
    @include('admin.racings.schedule.results.js')
@endsection