@extends('layouts.app', ['title' => $eteam->name . ' - Estadísticas', 'breadcrumb' => 'dark'])

@section('breadcrumb')
    @include('esports.eteams.eteam.stats.breadcrumb')
@endsection

@section('content')
	<div class="custom-container">
	    <div class="mt-4 mb-8">
	    	@include('esports.eteams.eteam.partials.title')
			@include('esports.eteams.eteam.partials.menu')
			@include('esports.eteams.eteam.stats.content')
			@include('esports.eteams.eteam.partials.footer')
		</div>
	</div>
@endsection