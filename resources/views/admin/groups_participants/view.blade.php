@extends('layouts.admin', ['title' => $group->name . ' - Participante #' . $group_participant->id, 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.groups_participants.view.breadcrumb')
@endsection

@section('content')
    @include('admin.groups_participants.view.content')
@endsection