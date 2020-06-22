@extends('layouts.admin', ['title' => 'Editar BD Jugadores', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players_databases.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.players_databases.edit.content')
@endsection

@section('js')
    @include('admin.players_databases.edit.js')
@endsection