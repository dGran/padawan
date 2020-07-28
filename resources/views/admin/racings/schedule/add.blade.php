@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras - Calendario - Nueva carrera', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.races.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.schedule.races.content')
@endsection

@section('js')
    @include('admin.racings.schedule.races.js')
@endsection