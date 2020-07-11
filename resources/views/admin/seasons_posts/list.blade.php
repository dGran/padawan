@extends('layouts.admin', ['title' => 'Noticias', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons_posts.list.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons_posts.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.seasons_posts.list.js')
@endsection