@extends('layouts.admin', ['title' => 'Dashboard'])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('content')
    @include('admin.dashboard.content')
@endsection