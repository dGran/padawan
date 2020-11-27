@extends('layouts.admin', ['title' => 'Nueva BD Jugadores', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players_databases.add.breadcrumb')
@endsection

@section('content')
    @include('admin.players_databases.add.content')
@endsection

@section('js')
    @include('admin.players_databases.add.js')
@endsection