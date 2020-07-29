@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras - Calendario', 'breadcrumb' => true])

{{-- @section('metas')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
 --}}
@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.list.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.schedule.list.content')
@endsection

@section('js')
    @include('admin.racings.schedule.list.js')
@endsection