@extends('layouts.admin', ['title' => $reserve->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.reserves.view.breadcrumb')
@endsection

@section('content')
    @include('admin.reserves.view.content')
@endsection