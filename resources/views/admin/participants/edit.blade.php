@extends('layouts.admin', ['title' => 'Editar participante #' . $participant->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.participants.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.participants.edit.content')
@endsection

@section('js')
    @include('admin.participants.edit.js')
@endsection