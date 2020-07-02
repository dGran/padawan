@extends('layouts.admin', ['title' => 'Participantes', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.participants.list.breadcrumb')
@endsection

@section('content')
    @include('admin.participants.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.participants.list.js')
@endsection