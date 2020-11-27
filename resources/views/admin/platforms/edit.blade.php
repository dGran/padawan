@extends('layouts.admin', ['title' => 'Editar plataforma', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.platforms.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.platforms.edit.content')
@endsection

@section('js')
    @include('admin.platforms.edit.js')
@endsection