@extends('layouts.admin', ['title' => $position->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.positions.view.breadcrumb')
@endsection

@section('content')
    @include('admin.positions.view.content')
@endsection