@extends('layouts.admin', ['title' => 'Editar posición', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.positions.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.positions.edit.content')
@endsection

@section('js')
    @include('admin.positions.edit.js')
@endsection