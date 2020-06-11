@extends('layouts.admin', ['title' => 'Nuevo usuario', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.users.add.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.users.add.content')
@endsection

@section('js')
    @include('admin.users.add.js')
@endsection