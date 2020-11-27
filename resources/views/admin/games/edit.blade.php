@extends('layouts.admin', ['title' => 'Editar juego', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.games.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.games.edit.content')
@endsection

@section('js')
    @include('admin.games.edit.js')
@endsection