@extends('layouts.admin', ['title' => 'Editar temporada', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons.edit.content')
@endsection

@section('js')
    @include('admin.seasons.edit.js')
@endsection