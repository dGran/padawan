@extends('layouts.admin', ['title' => 'Reservas', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.reserves.list.breadcrumb')
@endsection

@section('content')
    @include('admin.reserves.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.reserves.list.js')
@endsection