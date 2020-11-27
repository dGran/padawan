@extends('layouts.app', ['title' => 'Nuevo equipo', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteams.add.breadcrumb')
@endsection

@section('content')
	@include('esports.eteams.add.content')
@endsection

@section('js')
	@include('esports.eteams.add.js')
@endsection