@extends('layouts.admin', ['title' => 'Temporadas', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons.list.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.seasons.list.js')
@endsection