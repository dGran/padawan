@extends('layouts.admin', ['title' => 'Nuevo participante', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.participants.add.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.participants.add.content')
@endsection

@section('js')
    @include('admin.participants.add.js')
@endsection