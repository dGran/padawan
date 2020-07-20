@extends('layouts.admin', ['title' => $group->name . ' - Editar participante #' . $group_participant->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups_participants.edit.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.groups_participants.edit.content')
@endsection

@section('js')
    @include('admin.groups_participants.edit.js')
@endsection