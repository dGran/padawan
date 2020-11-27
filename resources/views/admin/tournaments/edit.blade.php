@extends('layouts.admin', ['title' => 'Editar torneo', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.tournaments.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.tournaments.edit.content')
@endsection

@section('js')
    @include('admin.tournaments.edit.js')
@endsection