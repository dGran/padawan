@extends('layouts.admin', ['title' => 'Editar competición #' . $competition->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.competitions.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.competitions.edit.content')
@endsection

@section('js')
    @include('admin.competitions.edit.js')
@endsection