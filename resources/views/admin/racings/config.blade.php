@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras', 'breadcrumb' => true])

@section('metas')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.config.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.config.content')
@endsection

@section('js')
    @include('admin.racings.config.js')
@endsection