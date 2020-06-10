@extends('layouts.admin', ['title' => $user->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.users.view.breadcrumb')
@endsection

@section('content')
    @include('admin.users.view.content')
@endsection