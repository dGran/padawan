@extends('layouts.admin', ['title' => $phase->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.phases.view.breadcrumb')
@endsection

@section('content')
    @include('admin.phases.view.content')
@endsection