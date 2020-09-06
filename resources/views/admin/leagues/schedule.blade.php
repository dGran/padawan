@extends('layouts.admin', ['title' => $group->name . ' - Gestión de ligas', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.leagues.schedule.list.breadcrumb')
@endsection

@section('content')
    @include('admin.leagues.schedule.list.content')
@endsection

@section('js')
    @include('admin.leagues.schedule.list.js')
@endsection