@extends('layouts.admin', ['title' => 'Editar jugador', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.players.edit.content')
@endsection

@section('js')
    @include('admin.players.edit.js')
@endsection