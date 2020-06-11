@extends('layouts.admin', ['title' => 'Editar usuario', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.users.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.users.edit.content')
@endsection

@section('js')
    @include('admin.users.edit.js')
@endsection