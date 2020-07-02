@extends('layouts.admin', ['title' => $participant->name, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.participants.view.breadcrumb')
@endsection

@section('content')
    @include('admin.participants.view.content')
@endsection