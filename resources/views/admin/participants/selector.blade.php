@extends('layouts.admin', ['title' => 'Selector de temporada', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.participants.selector.breadcrumb')
@endsection

@section('content')
    @include('admin.participants.selector.content')
@endsection

@section('js')
	@include('admin.participants.selector.js')
@endsection