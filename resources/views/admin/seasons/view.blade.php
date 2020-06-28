@extends('layouts.admin', ['title' => $season->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons.view.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons.view.content')
@endsection