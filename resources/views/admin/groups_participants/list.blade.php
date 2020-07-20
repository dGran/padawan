@extends('layouts.admin', ['title' => $group->name . ' - Participantes', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups_participants.list.breadcrumb')
@endsection

@section('content')
    @include('admin.groups_participants.list.content')
@endsection

@section('js')
    @include('admin.partials.list.js')
    @include('admin.groups_participants.list.js')
@endsection