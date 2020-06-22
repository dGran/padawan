@extends('layouts.admin', ['title' => $player_database->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players_databases.view.breadcrumb')
@endsection

@section('content')
    @include('admin.players_databases.view.content')
@endsection