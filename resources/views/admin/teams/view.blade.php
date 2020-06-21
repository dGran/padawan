@extends('layouts.admin', ['title' => $team->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.teams.view.breadcrumb')
@endsection

@section('content')
    @include('admin.teams.view.content')
@endsection