@extends('layouts.admin', ['title' => 'Editar noticia #' . $season_post->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.seasons_posts.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.seasons_posts.edit.content')
@endsection

@section('js')
    @include('admin.seasons_posts.edit.js')
@endsection