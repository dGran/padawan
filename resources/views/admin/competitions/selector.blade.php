@extends('layouts.admin', ['title' => 'Selector de temporada', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.competitions.selector.breadcrumb')
@endsection

@section('content')
    @include('admin.competitions.selector.content')
@endsection

@section('js')
	@include('admin.competitions.selector.js')
@endsection