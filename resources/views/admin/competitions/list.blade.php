@extends('layouts.admin', ['title' => 'Competiciones', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.competitions.list.breadcrumb')
@endsection

@section('content')
    @include('admin.competitions.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.competitions.list.js')
@endsection