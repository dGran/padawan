@extends('layouts.admin', ['title' => $group->name . ' - Gestión de carreras', 'breadcrumb' => true])

@section('menu')
	@include('admin.partials.menu')
@endsection

@section('breadcrumb')
    @include('admin.racings.schedule.add.breadcrumb')
@endsection

@section('content')
    @include('admin.racings.schedule.add.content')
@endsection

@section('js')
    @include('admin.racings.schedule.add.js')
@endsection