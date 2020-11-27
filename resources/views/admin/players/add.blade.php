@extends('layouts.admin', ['title' => 'Nuevo jugador', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players.add.breadcrumb')
@endsection

@section('content')
    @include('admin.players.add.content')
@endsection

@section('js')
    @include('admin.players.add.js')
@endsection