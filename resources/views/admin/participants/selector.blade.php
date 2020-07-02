@extends('layouts.admin', ['title' => 'Selector de torneo', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons.selector.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons.selector.content')
@endsection

@section('js')

@endsection