@extends('layouts.admin', ['title' => 'Editar participante', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.participants.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.participants.edit.content')
@endsection

@section('js')
    @include('admin.participants.edit.js')
@endsection