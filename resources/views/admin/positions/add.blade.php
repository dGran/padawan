@extends('layouts.admin', ['title' => 'Nueva posición', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.positions.add.breadcrumb')
@endsection

@section('content')
    @include('admin.positions.add.content')
@endsection

@section('js')
    @include('admin.positions.add.js')
@endsection