@extends('layouts.admin', ['title' => 'Nuevo reserva', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.reserves.add.breadcrumb')
@endsection

@section('content')
    @include('admin.reserves.add.content')
@endsection

@section('js')
    @include('admin.reserves.add.js')
@endsection