@extends('layouts.admin', ['title' => $group->name . ' - Gestión de ligas', 'breadcrumb' => true])

@section('metas')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.leagues.schedule.results.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.leagues.schedule.results.content')
@endsection

@section('js')
    @include('admin.leagues.schedule.results.js')
@endsection