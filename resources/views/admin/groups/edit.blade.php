@extends('layouts.admin', ['title' => 'Editar grupo #' . $group->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.groups.edit.content')
@endsection

@section('js')
    @include('admin.groups.edit.js')
@endsection