@extends('layouts.admin', ['title' => 'Grupos', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups.list.breadcrumb')
@endsection

@section('content')
    @include('admin.groups.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.groups.list.js')
@endsection