@extends('layouts.admin', ['title' => 'Editar fase #' . $phase->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.phases.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.phases.edit.content')
@endsection

@section('js')
    @include('admin.phases.edit.js')
@endsection