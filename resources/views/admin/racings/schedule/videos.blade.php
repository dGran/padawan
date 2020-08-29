@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.videos.breadcrumb')
@endsection

@section('content')
	@include('layouts.partials.flash_errors')
    @include('admin.racings.schedule.videos.content')
@endsection

@section('js')
    @include('admin.racings.schedule.videos.js')
@endsection