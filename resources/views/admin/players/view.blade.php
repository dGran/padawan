@extends('layouts.admin', ['title' => $player->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.players.view.breadcrumb')
@endsection

@section('content')
    @include('admin.players.view.content')
@endsection