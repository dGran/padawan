@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras - Calendario', 'breadcrumb' => true])

{{-- @section('metas')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 --}}
@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.schedule.content')
@endsection

@section('js')
    @include('admin.racings.schedule.js')
@endsection