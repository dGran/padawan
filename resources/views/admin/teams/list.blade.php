@extends('layouts.admin', ['title' => 'Equipos', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.teams.list.breadcrumb')
@endsection

@section('content')
    @include('admin.teams.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.teams.list.js')
@endsection