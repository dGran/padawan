@extends('layouts.admin', ['title' => 'Torneos', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.tournaments.breadcrumb')
@endsection

@section('content')
    @include('admin.tournaments.content')
@endsection

@section('js')
    @include('admin.partials.javascript')
    @include('admin.tournaments.js')
@endsection