@extends('layouts.admin', ['title' => 'Plataformas', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.platforms.list.breadcrumb')
@endsection

@section('content')
    @include('admin.platforms.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.platforms.list.js')
@endsection