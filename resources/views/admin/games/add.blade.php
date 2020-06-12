@extends('layouts.admin', ['title' => 'Nuevo juego', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.games.add.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.games.add.content')
@endsection

@section('js')
    @include('admin.games.add.js')
@endsection