@extends('layouts.admin', ['title' => $group->name . ' - Gestión de ligas', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.leagues.schedule.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.leagues.schedule.edit.content')
@endsection

@section('js')
    @include('admin.leagues.schedule.edit.js')
@endsection