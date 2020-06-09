@extends('layouts.admin', ['title' => 'Nuevo usuario', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.users.add.breadcrumb')
@endsection

@section('content')
    @include('admin.users.add.content')
@endsection

@section('js')
    {{-- @include('admin.partials.add.js') --}}
    {{-- @include('admin.users.add.js') --}}
@endsection