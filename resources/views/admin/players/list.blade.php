@extends('layouts.admin', ['title' => 'Jugadores', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players.list.breadcrumb')
@endsection

@section('content')
    @include('admin.players.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.players.list.js')
@endsection