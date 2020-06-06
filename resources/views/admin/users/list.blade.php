@extends('layouts.admin', ['title' => 'Usuarios', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.users.list.breadcrumb')
@endsection

@section('content')
    @include('admin.users.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.users.list.js')
@endsection