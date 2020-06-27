@extends('layouts.admin', ['title' => $tournament->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.tournaments.view.breadcrumb')
@endsection

@section('content')
    @include('admin.tournaments.view.content')
@endsection