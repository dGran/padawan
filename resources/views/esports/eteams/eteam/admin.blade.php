@extends('layouts.app', ['title' => $eteam->name. ' - Administración', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteams.eteam.admin.breadcrumb')
@endsection

@section('content')
	<div class="custom-container">
	    <div class="mt-4 mb-8">
			@include('esports.eteams.eteam.partials.title')
			@include('esports.eteams.eteam.partials.menu')
			@include('esports.eteams.eteam.admin.content')
			@include('esports.eteams.eteam.partials.footer')
		</div>
	</div>
@endsection