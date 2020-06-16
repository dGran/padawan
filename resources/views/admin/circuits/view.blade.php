@extends('layouts.admin', ['title' => $circuit->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.circuits.view.breadcrumb')
@endsection

@section('content')
    @include('admin.circuits.view.content')
@endsection