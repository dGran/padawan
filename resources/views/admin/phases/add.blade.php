@extends('layouts.admin', ['title' => 'Nueva fase', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.phases.add.breadcrumb')
@endsection

@section('content')
    @include('admin.phases.add.content')
@endsection

@section('js')
    @include('admin.phases.add.js')
@endsection