@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.videos.edit.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.schedule.videos.edit.content')
@endsection