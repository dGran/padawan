@extends('layouts.admin', ['title' => 'Editar reserva #' . $reserve->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.reserves.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.reserves.edit.content')
@endsection

@section('js')
    @include('admin.reserves.edit.js')
@endsection