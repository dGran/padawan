@extends('layouts.admin', ['title' => 'Nuevo torneo', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.tournaments.add.breadcrumb')
@endsection

@section('content')
    @include('admin.tournaments.add.content')
@endsection

@section('js')
    @include('admin.tournaments.add.js')
@endsection