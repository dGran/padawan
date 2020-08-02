@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.standings.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.standings.content')
@endsection

@section('js')
    @include('admin.racings.standings.js')
@endsection