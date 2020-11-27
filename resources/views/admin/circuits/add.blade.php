@extends('layouts.admin', ['title' => 'Nuevo circuito', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.circuits.add.breadcrumb')
@endsection

@section('content')
    @include('admin.circuits.add.content')
@endsection

@section('js')
    @include('admin.circuits.add.js')
@endsection