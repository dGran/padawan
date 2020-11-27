@extends('layouts.admin', ['title' => 'Editar circuito', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.circuits.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.circuits.edit.content')
@endsection

@section('js')
    @include('admin.circuits.edit.js')
@endsection