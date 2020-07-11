@extends('layouts.admin', ['title' => $season_post->title, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons_posts.view.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons_posts.view.content')
@endsection