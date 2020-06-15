@extends('layouts.admin', ['title' => 'Posiciones', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.positions.list.breadcrumb')
@endsection

@section('content')
    @include('admin.positions.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.positions.list.js')
@endsection