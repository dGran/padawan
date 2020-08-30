@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.videos.list.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.racings.schedule.videos.list.content')
@endsection

@section('js')
    @include('admin.racings.schedule.videos.list.js')
@endsection