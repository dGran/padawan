@extends('layouts.admin', ['title' => 'Nueva plataforma', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.platforms.add.breadcrumb')
@endsection

@section('content')
    @include('admin.platforms.add.content')
@endsection

@section('js')
    @include('admin.platforms.add.js')
@endsection