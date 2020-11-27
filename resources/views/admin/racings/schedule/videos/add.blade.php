@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.videos.add.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.schedule.videos.add.content')
@endsection