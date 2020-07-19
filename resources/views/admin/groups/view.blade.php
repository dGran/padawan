@extends('layouts.admin', ['title' => $group->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups.view.breadcrumb')
@endsection

@section('content')
    @include('admin.groups.view.content')
@endsection