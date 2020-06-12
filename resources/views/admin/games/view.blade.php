@extends('layouts.admin', ['title' => $game->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.games.view.breadcrumb')
@endsection

@section('content')
    @include('admin.games.view.content')
@endsection