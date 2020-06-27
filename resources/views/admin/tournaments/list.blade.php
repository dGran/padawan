@extends('layouts.admin', ['title' => 'Torneos', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.tournaments.list.breadcrumb')
@endsection

@section('content')
    @include('admin.tournaments.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.tournaments.list.js')
@endsection