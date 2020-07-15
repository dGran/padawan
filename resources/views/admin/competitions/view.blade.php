@extends('layouts.admin', ['title' => $competition->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.competitions.view.breadcrumb')
@endsection

@section('content')
    @include('admin.competitions.view.content')
@endsection