@extends('layouts.admin', ['title' => 'Selector de temporada', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons_posts.selector.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons_posts.selector.content')
@endsection

@section('js')
	@include('admin.seasons_posts.selector.js')
@endsection