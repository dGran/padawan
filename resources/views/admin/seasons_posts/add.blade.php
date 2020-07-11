@extends('layouts.admin', ['title' => 'Nueva noticia', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons_posts.add.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.seasons_posts.add.content')
@endsection

@section('js')
    @include('admin.seasons_posts.add.js')
@endsection