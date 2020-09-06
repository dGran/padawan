@extends('layouts.admin', ['title' => $group->name . ' - Gestión de ligas', 'breadcrumb' => true])

@section('metas')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.leagues.config.breadcrumb')
@endsection

@section('content')
    @include('admin.leagues.config.content')
@endsection

@section('js')
    @include('admin.leagues.config.js')
@endsection