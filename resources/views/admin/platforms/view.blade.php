@extends('layouts.admin', ['title' => $platform->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.platforms.view.breadcrumb')
@endsection

@section('content')
    @include('admin.platforms.view.content')
@endsection