@extends('layouts.admin', ['title' => 'Nueva competición', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.competitions.add.breadcrumb')
@endsection

@section('content')
    @include('admin.competitions.add.content')
@endsection

@section('js')
    @include('admin.competitions.add.js')
@endsection