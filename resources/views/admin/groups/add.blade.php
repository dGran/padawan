@extends('layouts.admin', ['title' => 'Nuevo grupo', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups.add.breadcrumb')
@endsection

@section('content')
    @include('admin.groups.add.content')
@endsection

@section('js')
    @include('admin.groups.add.js')
@endsection