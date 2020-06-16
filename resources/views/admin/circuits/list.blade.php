@extends('layouts.admin', ['title' => 'Circuitos', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.circuits.list.breadcrumb')
@endsection

@section('content')
    @include('admin.circuits.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.circuits.list.js')
@endsection