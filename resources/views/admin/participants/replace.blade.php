@extends('layouts.admin', ['title' => 'Reemplazar participante #' . $participant->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.participants.replace.breadcrumb')
@endsection

@section('content')
    @include('admin.participants.replace.content')
@endsection

@section('js')
    @include('admin.participants.replace.js')
@endsection