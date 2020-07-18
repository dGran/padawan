@extends('layouts.admin', ['title' => 'Fases', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.phases.list.breadcrumb')
@endsection

@section('content')
    @include('admin.phases.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.phases.list.js')
@endsection