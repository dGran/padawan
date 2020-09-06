@extends('layouts.admin', ['title' => $group->name . ' - Gestión de ligas', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.leagues.schedule.add.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.leagues.schedule.add.content')
@endsection

@section('js')
    @include('admin.leagues.schedule.add.js')
@endsection