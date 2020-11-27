@extends('layouts.admin', ['title' => 'Nueva temporada', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons.add.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons.add.content')
@endsection

@section('js')
    @include('admin.seasons.add.js')
@endsection