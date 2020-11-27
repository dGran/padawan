@extends('layouts.app', ['title' => $eteam->name . ' - Miembros', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteams.eteam.members.breadcrumb')
@endsection

@section('content')
	<div class="custom-container">
	    <div class="mt-4 mb-8">
			@include('esports.eteams.eteam.partials.title')
			@include('esports.eteams.eteam.partials.menu')
			@include('esports.eteams.eteam.members.content')
			@include('esports.eteams.eteam.partials.footer')
		</div>
	</div>
@endsection

@section('js')
	@include('esports.eteams.eteam.members.js')
@endsection