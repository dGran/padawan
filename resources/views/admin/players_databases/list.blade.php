@extends('layouts.admin', ['title' => 'BD Jugadores', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players_databases.list.breadcrumb')
@endsection

@section('content')
    @include('admin.players_databases.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.players_databases.list.js')
@endsection