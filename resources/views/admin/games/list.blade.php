@extends('layouts.admin', ['title' => 'Juegos', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.games.list.breadcrumb')
@endsection

@section('content')
    @include('admin.games.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.games.list.js')
@endsection