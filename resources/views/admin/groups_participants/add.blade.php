@extends('layouts.admin', ['title' => $group->name . ' - Nuevo participante', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups_participants.add.breadcrumb')
@endsection

@section('content')
    @include('admin.groups_participants.add.content')
@endsection

@section('js')
    @include('admin.groups_participants.add.js')
@endsection