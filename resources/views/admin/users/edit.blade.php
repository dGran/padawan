@extends('layouts.admin', ['title' => 'Usuarios', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.users.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.users.edit.content')
@endsection

@section('js')
    {{-- @include('admin.partials.edit.js') --}}
    {{-- @include('admin.users.edit.js') --}}
@endsection